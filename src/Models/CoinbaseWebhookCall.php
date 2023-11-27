<?php

namespace Antimech\Coinbase\Models;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Antimech\Coinbase\Exceptions\WebhookFailed;

class CoinbaseWebhookCall extends Model
{
    public $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'exception' => 'array',
    ];

    public function process(): void
    {
        $this->clearException();

        if ($this->type === '') {
            throw WebhookFailed::missingType($this);
        }

        event("coinbase::{$this->type}", $this);

        $jobClass = $this->determineJobClass($this->type);

        if ($jobClass === '') {
            return;
        }

        if (! class_exists($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobClass, $this);
        }

        dispatch(new $jobClass($this));
    }

    public function saveException(Exception $exception): static
    {
        $this->exception = [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ];

        $this->save();

        return $this;
    }

    protected function determineJobClass(string $eventType): string
    {
        $jobConfigKey = str_replace('.', '_', $eventType);
        
        return config("coinbase.webhook_jobs.{$jobConfigKey}", '');
    }

    protected function clearException(): static
    {
        $this->exception = null;

        $this->save();

        return $this;
    }
}