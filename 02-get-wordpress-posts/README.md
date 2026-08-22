# Example 02 – Get WordPress Posts via Custom REST API

## Overview

This example demonstrates how a custom WordPress REST API endpoint can retrieve real WordPress post data instead of returning only a fixed response.

The endpoint will use WordPress functions to fetch published posts and return selected post information as JSON.

## Endpoint

```text
/wp-json/ibrahim/v1/posts
```

## Request Method

```text
GET
```

## Expected Response

The endpoint will return published WordPress posts containing selected information such as:

- Post ID
- Post title
- Post URL

Example response:

```json
{
  "success": true,
  "posts": [
    {
      "id": 123,
      "title": "Example Post",
      "url": "https://example.com/example-post/"
    }
  ]
}
```
