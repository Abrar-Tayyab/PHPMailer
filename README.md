# How to use this PHPMailer library

This guide explains how to set up the email contact form in a simple and beginner-friendly way.

## 1. Place the files in your project
Make sure your project folder looks like this:

```text
your-project/
├── process.php
├── PHPMailLiabrary/
│   ├── credentials.php
│   ├── send_email.php
│   └── vendor/
```

- Keep the main processing file named `process.php` in your project root.
- Keep the library folder named `PHPMailLiabrary` as it is.

## 2. Update the SMTP settings
Open the file [PHPMailLiabrary/credentials.php](PHPMailLiabrary/credentials.php) and replace the example values with your real email details.

You should update these values:

- `customer`: the name shown as the sender
- `brand_name`: your website or company name
- `host`: your SMTP host
- `port`: your SMTP port
- `from_email`: the email address used to send the message
- `password`: your SMTP password

Example:

```php
$customer = 'My Website';
$brand_name = 'My Website';
$host = 'smtp.example.com';
$port = 465;
$from_email = 'noreply@example.com';
$password = 'your-smtp-password';
```

## 3. Update the main process file
Open [process.php](process.php) and change these values:

- `recipient_email`: the email address that should receive the form messages
- `redirect_url`: the page the user should return to after sending the form
- `website_logo_url`: optional logo URL for the email template

Example:

```php
$recipient_email = 'youremail@example.com';
$redirect_url = 'http://localhost/contact-form.php';
$website_logo_url = 'https://yourdomain.com/logo.png';
```

## 4. Connect your HTML form
Your form should point to the processing file.

Example:

```html
<form action="process.php" method="post">
  <input type="text" name="name" placeholder="Your Name" required>
  <input type="email" name="email" placeholder="Your Email" required>
  <textarea name="message" placeholder="Your Message" required></textarea>
  <button type="submit">Send</button>
</form>
```

The values from the form will be collected automatically and sent to your email.

## 5. Test the form
After everything is updated:

1. Open your contact page in the browser.
2. Fill in the form.
3. Submit it.
4. Check the inbox of the receiving email address.

## 6. If the email does not send
Check the following:

- SMTP details are correct
- The SMTP host and port match your email provider
- Your email provider allows SMTP authentication
- The website is running on a server that can connect to the SMTP server

If you are using a local server, make sure your SMTP settings are valid for localhost testing.
