<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Projet laravel auth 

un projet pour l'&authentification + verification opt + verification de session unique

# Fonctionalite

 1-Inscription avec OTP obligatoire

- Lors de l’inscription (register), un OTP à 6 chiffres est généré et stocké en base.

- L’utilisateur ne peut pas se connecter tant que l’OTP n’est pas validé.

- L’OTP a une durée de validité (otp_expires_at, ex. 10 minutes).

- Un email est envoyé automatiquement avec ce code.



2- Vérification OTP

 - L’utilisateur entre son code reçu par mail.

 - Si le code est correct et valide 

 - L’utilisateur est connecté automatiquement et redirigé vers son dashboard.

 - Si l’OTP est expiré et que l’utilisateur n’a jamais validé →

 - Le compte est supprimé de la base pour éviter les utilisateurs “fantômes”.


 3- Renvoi OTP avec limitation (anti-spam)

  - Un utilisateur peut redemander un code OTP.

 - Pour éviter le spam, on vérifie un délai d’attente (ex. 2 minutes) avant d’envoyer un nouveau code.

 4- Avatar automatique

 - Si l’utilisateur ne télécharge pas de photo lors de l’inscription :

 - Un avatar est généré automatiquement avec la première lettre de chaque mot de son nom.

 - Fond coloré aléatoire.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
