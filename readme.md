
# Agcmanager Receiver

To create a post in wordpress agcmanager need receiver so we can make post and publish attachment on your wordpress site

We used basic authentication to connect on your wordpress site. Authentication is included on your Wordpress dashboard. You can re-generate authentication if you feel something steal your key.

## Usage

1. Download [Plugin Here](https://github.com/robzlabz/agcmanager-wordpress/archive/master.zip) and upload to your wordpress plugin.
2. Goto Agcmanager menu, you can find your key and paste on [Agcmanager](https://agcmanager.com)
3. Have fun

## API

END POINT

``` txt
${HOST}/wp-admin/admin-ajax.php
```

### Verify Token

Params

- action = agc_verify
- token

Response

``` json
{
    status: "match",
    message: "Valid token"
}
```

### Create Post

Params

- action = agc_post
- token
- title
- slug
- content
- status
- tags
- category

Response

```json
{
    post_id: 32,
    status: "success",
    message: "post #32 is created"
}
```

### Create Attachment

Params

- action = agc_attachment
- token
- post_id
- title
- slug
- content
- image
- filename

Response

```json
{
    attachment_id: 32,
    status: "success",
    message: "Attachment #32 is created"
}
```

Done!
