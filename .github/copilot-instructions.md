# Copilot instructions

- Work in small, reviewable steps. Before implementation, identify the behavior and discuss meaningful trade-offs when requirements are unclear.
- Use test-driven development: add or update a focused failing test first, implement the smallest change that makes it pass, then refactor with tests green.
- Prefer SOLID design and small, cohesive, independently testable components. Keep controllers focused on HTTP concerns and use Laravel conventions such as Form Requests for validation, Eloquent for persistence, API Resources for response shaping, and dependency injection.
- Avoid speculative abstractions, unnecessary repository wrappers around Eloquent, and introducing services or interfaces without a clear domain need.
- Cover success paths, validation failures, and relevant edge cases. Use unit tests for isolated logic and feature tests for routes, HTTP responses, and persistence behavior.
- Preserve Laravel's established response and error behavior; validate untrusted input and return appropriate HTTP status codes.
- Keep the solution backend-focused. Do not add authentication, frontend features, or external integrations unless the task requires them.
- Run the narrowest relevant PHPUnit suite, then `composer test` and `composer lint` when practical. Do not skip or weaken tests to make a change pass.
