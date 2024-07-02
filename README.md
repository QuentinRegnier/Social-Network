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

## Verify System

After connecting to the site, the **web server** creates `tmp` and `id` **cookies** for the user *(the option to refuse cookies is under development)*. This cookie is essential as it serves as the **authentication key** throughout the session. With **every page change**, the `verify.php` script is executed to ensure the **session's authenticity**. This script **checks** if the `tmp`and `id` cookies **exist** and are **not empty**. It then retrieves the `tmp` value associated with the user's identifier `('id')` from the database. If the `tmp` value in the database **matches the one stored in the cookie**, the user is considered **authentic**. At this point, a new 'tmp' is **generated** and **updated** in the database and the cookie, rendering the previous value **obsolete and preventing session hijacking** if someone intercepts the cookie's value.

<img src="https://i.imgur.com/hIEV5n9.png" width="100%" />

`verify_sys.php` is used for sensitive operations like **data modification or deletion**. Unlike `verify.php`, this script retrieves the user identifier not from the `id` cookie but using a value **transmitted via `POST`**, specified by the `$_POST[$id_name]` variable. It then checks if the `tmp` value **matches** the expected one for this identifier. If the match is not found, the script **terminates execution**. This prevents any **unauthorized action**, even if someone manages to obtain the `tmp`, because without the **correct identifier transmitted in POST**, **access will be denied**.

**The mechanism of regenerating** `tmp` on each page is similar to the **system used in modern car keys**, where the code transmitted between the key and the car changes with **each use**, thus preventing theft by **signal interception**. In this way, even if an **attacker intercepts** the `tmp` cookie, they will **not be able to use it** for further authentication, as this cookie will have already been replaced by a **new one**, just like the car key code that changes with **each use** to prevent **malicious reuse**.

<img src="https://i.imgur.com/nbvpsaE.png" width="100%" />

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

## Profile Page

The profile page is the only personalization and self-expression page visible on the entire website. It is therefore crucial to expose the user's activities and the trace he leaves on the website, as he wishes, in order to make his profile attractive to other users, and to bring about the objective of our platform, in this case social interaction with other users.

<img src="https://i.imgur.com/p3WGT0v.png" width="100%" />

### Comment & Like Systems

For the recreation of publications such as Instagram and Facebook, you can easily consult the various images (including gifs) that make up the publication using directional arrows. There's also a like and comment system (with the option of replying to comments coming soon).

<img src="https://i.imgur.com/BIB8VlA.png" width="100%" />

The send_comment function is designed to allow a user to send a comment on a publication. When a user submits a comment, this function is called and proceeds as follows: first, it prevents the page from scrolling by modifying the **CSS** style of the **HTML** element to hide the vertical scroll bar. Next, it retrieves the comment text entered by the user in a textarea element. With this information, it sends an asynchronous **HTTP POST request** to a PHP file named `comment-pgrm.php`, transmitting the content of the comment, a temporary code associated with the publication **(tmp_code_pub)**, and the user's identifier.
After sending the request, the function waits for a response from the server. If the response does not indicate an error **(error1 or error2)**, the function updates the user interface: it deletes the comment entry field, resets the comment character counter and inserts the new comment at the top of the list of existing comments on the page, using the server response containing the **HTML** of the added comment.
The **like_db** function manages the "like" or "j'aime" functionality for publications. When a user likes or unlikes a publication, this function sends an asynchronous **HTTP POST request** to `like-pgrm.php`, including the user and publication ID. Depending on the server's response, which may be sent to indicate the addition of a "like" or deleted to indicate its removal, the function visually updates the "like" button and the counter associated with the publication to reflect the user's action.
The `comment-pgrm.php` file handles the addition of new comments to the database. First, it checks that the necessary parameters have been transmitted by the POST request: the comment content, the user ID and the temporary publication code. If these parameters are valid and not empty, the script inserts the new comment into the database and returns a piece of **HTML** code representing the comment, which will be directly inserted into the **client-side** web page. In the event of missing or invalid parameters, the script returns an error message.
The `like-pgrm.php` file manages the "likes" of publications. It checks whether a "like" already exists for the publication-user combination in the database. If a "like" is found, it is deleted, and the script returns the word delete to indicate this action. If no "like" exists, a new one is added to the database, and the script returns send to indicate the addition.

<img src="https://i.imgur.com/0SPJ5vw.png" width="100%" />
