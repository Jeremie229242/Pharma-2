<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Projet laravel auth 

un projet pour l'&authentification + verification opt + verification de session unique

# Fonctionalite

Inscription avec OTP obligatoire

-Lors de l’inscription (register), un OTP à 6 chiffres est généré et stocké en base.

-L’utilisateur ne peut pas se connecter tant que l’OTP n’est pas validé.

-L’OTP a une durée de validité (otp_expires_at, ex. 10 minutes).

-Un email est envoyé automatiquement avec ce code.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
