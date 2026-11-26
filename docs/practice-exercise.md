# Mock interview exercise: school room bookings

This is a fictional practice prompt, not a prediction of the interview task. It is intentionally small and leaves some details open so you can practise clarifying requirements before choosing a design.

## How to practise

For a realistic run, read only the **Prompt to reveal** section first. Ask a friend to play the interviewer and reveal details from **Clarifications** only when you ask a relevant question. If practising alone, write down your questions and assumptions before reading the clarifications.

Use the [interview checklist](./README.md) to work through the prompt. Talk through your reasoning, keep the first implementation small, and stop to review what you have built. Do not treat the optional extension as required.

## Prompt to reveal

School staff currently coordinate room bookings informally. Build a small backend HTTP API that lets staff create a booking for a room and view bookings for that room.

A booking should identify the room, the organizer, and when the booking starts and ends. Use PHP and MySQL. There is no need for a UI, authentication, or external services.

Before coding, talk through what you understand, what you would clarify, and how you would approach a first useful slice. You do not need to build a complete production system.

## Clarifications

Reveal these only in response to questions, or have the practice partner choose a few to volunteer as the conversation develops.

### Domain rules

- Room names are supplied as text; there is no separate room catalogue to manage.
- A room must not have two active bookings whose time ranges overlap.
- A booking ending at the exact time another starts is allowed.
- Start and end are ISO 8601 date-times with offsets. Treat the represented instants consistently when comparing bookings and persisting them.
- Past bookings are allowed; there is no rule that a booking must be in the future.
- Room and organizer are required, non-empty strings. The organizer is a label, not a user account.

### API behavior

- Creating a booking should return the created booking and an appropriate success status.
- A time conflict should be distinguishable from invalid input.
- Listing bookings for a room with no matches should return an empty collection, not an error.
- The list should be ordered by start time, earliest first.
- There is no requirement to filter or paginate the list in the initial version.

### Optional extension

If the core behavior is working and there is time, add a way to cancel a booking by its identifier. A cancelled booking should no longer block a new booking for the same room and time. Ask how cancellation should appear in the API and data model before implementing it.

## Questions to ask before coding

Use your own questions first. These are examples of useful uncertainties to resolve:

- Can the same room have overlapping bookings?
- Are adjacent bookings allowed when one ends exactly as another begins?
- What should happen when the requested time range conflicts?
- What format and timezone should date-times use?
- Should an unknown room be an error, or can bookings introduce room names?
- What should listing return when there are no bookings?
- Is cancellation, editing, filtering, or pagination part of the required scope?
- Which behavior should take priority if time is limited?

Confirm the answers, summarize the acceptance criteria, and state any remaining assumptions aloud.

## A reasonable practice sequence

1. **Restate the goal.** Describe the two main actions and the core booking rule in your own words.
2. **Agree on the first slice.** For example, create a booking and list a room's bookings, including validation and conflicts.
3. **Sketch one request.** Trace input through validation and persistence to the response; identify the data fields and useful database constraints.
4. **Name important edge cases.** Try invalid or reversed times, equal boundaries, overlapping ranges, and an empty list.
5. **Implement incrementally.** Start with a focused test, then add the smallest route/model/database changes needed for that behavior. Run the relevant test before expanding scope.
6. **Review and explain.** Check responses, conflict behavior, tests, and the diff. Explain what you completed, what you did not, and what you would improve next.

The sequence is a guide, not a prescribed architecture. Follow the project conventions and explain the trade-offs behind the design you choose.

## Self-review

After a practice run, ask yourself:

- Did I clarify the overlap rule and time-boundary behavior before implementing it?
- Can I explain how the chosen persistence approach handles a conflict?
- Did I define understandable success, validation, not-found, and conflict responses?
- Did I cover the main behavior with focused tests?
- Did I keep the implementation proportional to the prompt?
- Did I communicate assumptions, progress, and test results as I worked?
- Could I explain every part of the code and identify a sensible next improvement?
