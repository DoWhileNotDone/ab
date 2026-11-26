# Technical interview exercise: working checklist

Use this as a process guide when the exercise domain is revealed, not as a solution to prepare in advance. The brief describes a collaborative, backend-focused PHP and MySQL HTTP API task. The aim is to show clear thinking, sensible trade-offs, readable code, and how you communicate—not to deliver a polished or complete system.

For a fictional prompt to practise this process, see [the mock room-booking exercise](./practice-exercise.md).

## Before the interview

- Confirm the IDE opens the project and Git works.
- Check that the supplied PHP project starts and can connect to MySQL.
- Know how to run the test suite and inspect a failing test.
- Check Google Meet camera permissions and be ready to share your screen.
- Do not build or rehearse a solution for an unknown domain.

## 1. Read the task and agree on scope

Before coding, read the whole prompt and explain your understanding back to the interviewer. Use the time to clarify the desired behavior and agree what a useful first slice looks like.

- Identify the user or system need and the main outcome.
- List the required operations, inputs, and expected responses.
- Ask about ambiguous rules, important edge cases, and what is explicitly out of scope.
- Confirm any constraints in the prompt rather than assuming them. The exercise brief itself says no authentication or external integrations; follow the revealed task if it adds detail.
- State a small set of assumptions when time or information is limited, and invite correction.
- Turn the requirements into a short, observable acceptance checklist.

Useful questions:

- “What should happen when this input is missing or invalid?”
- “Are duplicates allowed, and what defines a duplicate?”
- “What should the API return when the record does not exist?”
- “Which part would you most like me to demonstrate if time is limited?”

## 2. Sketch the design before implementation

Keep the design proportional to the problem. Walk through one representative request from HTTP input to response, and check that the data model supports the required behavior.

- Name the domain concepts and their important fields and relationships.
- Sketch the API route, request shape, validation, success response, and likely error responses.
- Identify persistence needs: tables, keys, constraints, and any important uniqueness or deletion rules.
- Note relevant edge cases, such as empty results, invalid identifiers, duplicate submissions, or boundary values.
- Separate responsibilities using the project’s existing conventions. In Laravel, that may mean routes/controllers, Form Requests, Eloquent models, Resources, migrations, and tests; use only the pieces the task needs.
- Call out one or two trade-offs and why the simpler option is appropriate for this exercise.

Avoid designing future systems that the prompt does not require. A UI, authentication, integrations, elaborate abstractions, and premature optimization are not goals unless the task specifically asks for them.

## 3. Implement a small vertical slice

Start with the smallest end-to-end behavior that proves the core requirement: request, validation, persistence if needed, and response.

1. Make sure the project and database are in a known working state.
2. Add or update a focused test for the first acceptance criterion, where practical.
3. Implement the route and only the supporting code it needs.
4. Run the narrowest relevant test and fix failures before adding more behavior.
5. Add the next requirement or edge case in a similarly small step.
6. Keep the interviewer informed about what you are doing, what is working, and any assumption you are making.

Prefer readable names and straightforward control flow. Validate untrusted input, use appropriate HTTP status codes, and return consistent response shapes. Keep persistence rules close to the data model and HTTP-specific concerns in the request/response layer, following the conventions already present in the project.

If you use an AI coding tool, treat its output as a suggestion: check the diff, run the relevant tests, and be ready to explain every change. Use it only if it helps you work and communicate more effectively.

## 4. Review the result

Reserve time to verify the behavior rather than adding one more speculative feature.

- Re-run the focused tests; run the broader suite if time allows.
- Try the main success path and at least one invalid or missing-data path.
- Check migrations and database constraints match the behavior you described.
- Read the changed files and diff for accidental or unrelated edits.
- Confirm the API response and status codes match the agreed acceptance checklist.

Be explicit about anything not completed or not verified. Do not imply that an unrun test passed.

## 5. Explain and discuss next steps

Summarize the delivered behavior, the design choices you made, and the tests you ran. Then distinguish current limitations from possible future improvements.

Consider improvements only when relevant, for example pagination for growing collections, stronger concurrency handling, authorization if the product requires it, observability, or performance work supported by evidence. Explain what you would prioritize next and why; do not implement these just to make the solution look more complex.

## Other interview phases

The exercise may also include a pull request review and a whiteboard discussion. Keep each focused on evidence and clear communication.

### Pull request review

- Read the description and surrounding code before judging an isolated diff.
- Trace the changed behavior and check correctness, error handling, data integrity, and tests.
- Report actionable findings with the location, impact, and a concise example or scenario.
- Separate blocking issues from questions and optional suggestions.
- Mention what you checked and any uncertainty; avoid nitpicks that do not affect maintainability or behavior.

### Whiteboard

- Restate the goal and agree the scope before drawing components.
- Sketch the primary request/data flow, API boundary, and persistence.
- Add validation and failure paths, not only the happy path.
- Explain the simplest design that meets the requirements, then discuss trade-offs and likely future changes.
- Keep the diagram legible and narrate it as you go. Use the whiteboard tool you are comfortable with.

## Keep in mind

The interview is collaborative. Ask questions, make your reasoning visible, and adapt when the interviewer gives new information. A small, correct, well-explained solution is better than a larger solution built on unconfirmed assumptions.
