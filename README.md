# Social-Network
## My objective
My goal is to recreate all the functionalities of a modern social network such as Facebook, Instagram and X. My different scripts are mainly created using my own framework, which I'm gradually building up. However, I sometimes use open-source frameworks for security and emoji, but in the long run my aim is to create my own functionalities. Ultimately, I want to recreate everything from 0. Code sovereignty is the most important thing for me.
## Global Organisation of Data Trafic 
This is not exact data traffic, as it incorporates features under development e.g. (Stripe/WebSocket)

<img src="https://i.imgur.com/1lI0PQZ.png">

### Login and Registration Process:

When a user registers or logs in, a POST request is typically used to securely transmit the credentials to the server.
For email verification during registration, the server might send an email with a unique token via an SMTP protocol, and the user would send a GET request to the verification URL which includes this token.
Login success would redirect the user to their profile page, often using an HTTP 302 status code for redirection.

### Profile and Settings Management:

Updating a profile or settings would usually involve a POST request to submit changes.
If the settings are updated frequently, an AJAX call with an XHR object could be used to asynchronously update user preferences without reloading the page.

### Payment Processing with Stripe:

Stripe integration for handling payments often involves both server-side and client-side operations.
The client-side might use Stripe's JS library to create a secure token via POST, ensuring that sensitive payment information doesn't touch your server.
The server would then use this token to create a charge via Stripe's REST API, which is a server-to-server POST request.

### Real-time Chat and Messaging:

Real-time communication in chat systems can be handled using WebSockets, which provide a persistent connection between the client and the server for bidirectional message passing.
For non-real-time updates, such as checking for new messages, AJAX with XHR or Fetch API could be used to periodically send GET requests.

### Error Handling and Notifications:

If the server encounters an error, it would send a response with an appropriate HTTP error status code (4xx for client errors, 5xx for server errors).
Notifications about new messages or user actions might use Server-Sent Events (SSE) or WebSockets to push updates from the server to the client.

### Content Algorithm and Feed Updates:

The server-side algorithm likely processes content requests using a GET method if it's simply retrieving data.
If the user's actions refine what content is shown (e.g., liking or disliking a post), a POST request could be used to update the server with the user's input, which in turn affects the algorithm's output.

### Signal Transmission:

Certain user actions or settings changes may generate signals. These could be sent via AJAX calls using POST requests if a change is being transmitted, or GET requests if retrieving new data based on the changes.
If the server needs to update multiple clients about a change (like a chat message), it might use WebSockets to broadcast this information to all connected clients.

## Login page
The login/registration page is the first thing your website offers your new user. For registration, I ask for several personal details, such as username, e-mail address, password, date of birth, general terms and conditions of use and sale, as well as for whom the account is intended (woman, man or couple).

<img src="https://i.imgur.com/NPfD95N.png" width="100%" />

### Encryption & Decryption Process
But to send confidential data such as e-mail addresses and passwords, I need an encryption and decryption process in addition to using the HTTPS protocol.

<img src="https://i.imgur.com/zNbpwdJ.png" width="100%" />

This encryption and decryption process for an online registration form utilizes a sophisticated combination of **symmetric** and **asymmetric** encryption to ensure the security of user data.

On the client side, when a user fills out the registration form and submits their information - typically a nickname and an email address - these data are captured by a JavaScript function named `checkindb`. This function prepares the data for encryption and initiates an asynchronous **XMLHttpRequest** (**XHR**). It then calls the `crypterEtEnvoyer` function, which is responsible for encrypting the data. This function generates a random **AES 256 key** and an initialization vector (**IV**), encrypts the **AES key** with the server's **public RSA 4096 key** using the **OpenPGP** library, and then encrypts the user's data with the **AES key**. It returns an object containing the encrypted data, the **RSA**-encrypted **AES key**, and the **IV**.

The encrypted data package is then sent to the **server-side** **PHP** script using an **AJAX** request. This enables secure transmission of data to the server, where it will be decrypted and processed.

On the server side, the `checkconditionregister.php` script receives the package of encrypted data. This script's role is to check whether the submitted nickname and email already exist in the database. It includes a `Decrypt` function from the `RSA4096AES256.php` file, which is tasked with decrypting the data received from the client. The `Decrypt` function performs several steps: it decodes the **JSON package** to extract the encrypted **AES key**, the **IV**, and the encrypted user data; it configures the server's **GnuPG** environment and loads the server's **private RSA key**; it decrypts the **RSA-encrypted AES key**, thus retrieving the original **AES key** in **hexadecimal** format; this key is then converted into binary format, as is the **IV**; finally, the encrypted user data, which is encoded in **base64**, is decoded and then decrypted using the **AES algorithm** with the decrypted **AES key** and **IV**.
