async function crypterEtEnvoyer(data) {
    try {
        const publicKeyRSA = "MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA2dwP2BYlxJaaccDo39Wsy/4qE/o4Tr6amyI1ABF5NRsr3pn1VeGLtfFyoTBD695guNC0jAAPqXwVw5+2pUkI6BIWxiA70txNixLuV18Qi7/cWmXoM5Uz2g6RrTHCQm6dHu2F9HC9fxI2dEeCbyLUsDphQecXNY93aKqmYwTAQDXMcxQ68mQ0CvRnso578bGPvI/1U08S39H7UeSO4ewya/VcpLSYF42maoqEYWYL9OCu45uHndpp/9G6HGmJ9DzkbDVbvKhtOahoD6IFsxiCZWvFWxGkPuxQoQL4m37Yla/0fAmbZPsOc3eJRRyvMZiCEOAwQJxPQvcPVvGWaT/IeL7K0uyRB+Ox4WDL9PNLF1j8o7OEZmFDaLuz6qWXAHBFwmvwSw8txCy6lD3eA8Z4Xhp/NYM7TvHZQs+dEHra1ESem96o7M/F94M8m22ddoR6ZHF91cCJ/jd83DZtOSuU6Ck4zGWAe5IyH2OmM6rgNngmYRlZzcWpF0u6j+H0+928FAkNN12UdrHf3aiSvTN9BpnBFKnN2TXGRhJxPaRvmvD7KMPjyDRMyZeDLHKIA37h3shcl4vi1vQfh/Q97Sxic5FXThpl+tzL8aFIZ+rhLxB84BkfwEHXd20nzv15b8763JRPMAVeex/C+FlAH5Kxda4vshqykvfZesgmu4ZOK9MCAwEAAQ=="; // Insérez ici la clé publique RSA du serveur

        // Vérifiez que la clé publique RSA est valide
        if (!publicKeyRSA) {
            throw new Error("Clé publique RSA manquante ou invalide.");
        }

        // Générer une clé AES aléatoire
        const cleAES_data = CryptoJS.lib.WordArray.random(16).toString();

        // Crypter la clé AES avec RSA
        const publicKey = await openpgp.readKey({ armoredKey: publicKeyRSA });
        const cleAESCryptee = await openpgp.encrypt({
            message: await openpgp.createMessage({ text: cleAES_data }),
            encryptionKeys: publicKey
        });

        // Crypter les données avec AES
        const donnees_data = data;
        const donneesCryptees = CryptoJS.AES.encrypt(JSON.stringify(donnees_data), cleAES_data).toString();
        return [donnees: donneesCryptees, cleAES: cleAESCryptee]
    } catch (error) {
        console.error("Erreur dans le processus de cryptage : ", error);
    }
}