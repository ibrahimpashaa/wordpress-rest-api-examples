# Example 03 – Get a Single WordPress Post by ID

## Overview

This example demonstrates how a custom WordPress REST API endpoint can retrieve one specific WordPress post using its post ID.

Instead of returning a list of posts, the endpoint reads the post ID from the URL and returns only the matching published WordPress post.

The endpoint also validates whether the requested post exists and whether it is publicly available.

## Endpoint

```text
/wp-json/ibrahim/v1/posts/{id}
```

Example:

```text
/wp-json/ibrahim/v1/posts/32
```

## Request Method

```text
GET
```

## Route Parameter

The endpoint accepts a dynamic post ID from the URL.

Example:

```text
/posts/32
```

Here:

```text
32 = WordPress Post ID
```

The route only accepts numeric post IDs.

## Successful Response

If the requested post exists and has a `publish` status, the API returns a successful response.

Example:

```json
{
  "success": true,
  "post": {
    "id": 32,
    "title": "Learning REST API",
    "url": "https://ibrahim.whipwave.co.uk/learning-rest-api/",
    "excerpt": "Created from Postman"
  }
}
```

HTTP Status:

```text
200 OK
```

## Error Response – Post Not Found

If the requested post ID does not exist, the API returns:

```json
{
  "success": false,
  "message": "Post not found."
}
```

HTTP Status:

```text
404 Not Found
```

## Error Response – Post Not Publicly Available

If the post exists but is not published, for example if its status is `draft`, the API returns:

```json
{
  "success": false,
  "message": "Post is not publicly available."
}
```

HTTP Status:

```text
404 Not Found
```

## Validation Logic

The endpoint performs the following checks:

1. Reads the post ID from the REST API URL.
2. Converts the ID to an integer.
3. Retrieves the post using `get_post()`.
4. Checks whether the post exists.
5. Checks whether the resource is a WordPress `post`.
6. Checks whether the post status is `publish`.
7. Returns the selected post data when all checks pass.

## What This Example Teaches

- How to create a REST API route with a dynamic parameter
- How to capture a post ID from the URL
- How to convert the post ID to an integer
- How to retrieve a WordPress post using `get_post()`
- How to check whether a requested post exists
- How to validate the WordPress post type
- How to validate the post status
- How to return `404 Not Found` responses
- How to return a `200 OK` response
- How to return selected WordPress post data as JSON
- How to test different API scenarios using Postman

## API Test Results

The endpoint was tested successfully in Postman using three different scenarios:

### 1. Published Post

Request:

```text
GET /wp-json/ibrahim/v1/posts/32
```

Result:

```text
200 OK
```

The published post information was returned successfully.

### 2. Post ID Does Not Exist

A non-existing post ID was requested.

Result:

```text
404 Not Found
```

Response:

```json
{
  "success": false,
  "message": "Post not found."
}
```

### 3. Post Exists but Status Is Draft

An existing WordPress post with `draft` status was requested.

Result:

```text
404 Not Found
```

Response:

```json
{
  "success": false,
  "message": "Post is not publicly available."
}
```

## Example Structure

```text
03-get-single-post/
├── screenshots/
│   ├── Screenshot_id dose not exist.png
│   ├── post exist but status is draft.png
│   └── screenshot get post by id.png
├── README.md
└── get-single-post.php
```

## Screenshots

The `screenshots` directory contains Postman test results demonstrating:

- Successful retrieval of a published post
- A request for a post ID that does not exist
- A request for an existing post whose status is draft

## Purpose

The purpose of this example is to understand how REST API routes can accept dynamic values from a URL and use those values to retrieve a specific WordPress resource.

This example also introduces an important API development concept: **validation**.

An API should not only retrieve data. It should also verify that the requested resource exists and that the client is allowed to receive that resource.

This prepares the project for more advanced REST API operations such as creating, updating, and deleting WordPress resources.
