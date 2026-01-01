<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // Intentionally left empty — we override render for specific DB errors below.
    }

    /**
     * Render an exception into an HTTP response.
     *
     * If the database PDO driver is missing and a QueryException is thrown with
     * "could not find driver", return a 503 Service Unavailable with a short
     * message instead of allowing a stack trace / fatal error to appear.
     */
    public function render($request, Throwable $e)
    {
        $message = (string) $e->getMessage();

        // If the error indicates a missing PDO driver, return a friendly 503.
        if ((($e instanceof QueryException) || ($e instanceof PDOException) || str_contains($message, 'could not find driver')) && str_contains($message, 'could not find driver')) {
            return response()->view('errors.pdo_missing', ['message' => 'Required PHP PDO driver for your configured database is not installed. Please install the driver (e.g. pdo_mysql) and restart PHP.'], 503);
        }

        return parent::render($request, $e);
    }
}
