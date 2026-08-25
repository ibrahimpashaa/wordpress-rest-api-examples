# Example 03 – Get a Single WordPress Post by ID

## Overview

This example demonstrates how a custom WordPress REST API endpoint can retrieve one specific WordPress post using its post ID.

Instead of returning a list of posts, the endpoint will read the post ID from the URL and return only the matching published post.

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

## Expected Response

The endpoint will return selected information for one WordPress post.

Example response:

```json
{
  "success": true,
  "post": {
    "id": 32,
    "title": "Learning REST API",
    "url": "https://example.com/learning-rest-api/"
  }
}
```

## What This Example Teaches

- How to use a dynamic route parameter
- How to read a post ID from the REST API request
- How to retrieve one WordPress post with `get_post()`
- How to check whether the post exists
- How to return a `404` response when a post is not found
- How to return selected post data as JSON

## Planned Structure

```text
03-get-single-post/
├── README.md
├── get-single-post.php
└── screenshots/
    └── postman-single-post-response.png
```

## Purpose

The purpose of this example is to understand how REST API routes can accept dynamic values from the URL and use those values to retrieve a specific WordPress resource.
