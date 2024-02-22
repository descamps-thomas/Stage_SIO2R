			
	DOCUMENTATION DOMAINEDPP


Contexte :Je vais vous présenter mon projet que j’ai du réaliser en stage sur une durée de 5 semaines.
Le contexte est une entreprise qui à besoins d’un site web.
J’ai donc décidé de prendre un domaine de pêche prés de chez moi.

Introduction : Le site que j’ai réalisé a plusieurs fonctionnalité avec une partie utilisateur est une autres partie administrateur ce qui permet de gérer des fonctionnalité que je vais vous présenté plus bas 

PARTIE ACCUEIL

Le site est composé d’une page d’accueil avec un parallaxe qui permet d’avoir l’image qui bouge en même temps que l’on défile dans la page.
Puis d’une NavBar qui bouge en fonction du déplacement de l’utilisateur sur la page.






















PARTIE INSCRIPTION

Quand vous allez arrivé sur le site web la première page est une présentation global du domaine avec ses différents étangs est pécheurs.
Sur la barre de navigation en haut vous retrouverez plusieurs bouton qui exécute différente action , nous allons nous diriger vers le bouton d’inscription.
Ce bouton permet au utilisateur de créé leur compte avec un nom, prénom, e-mail, mot de passe, est la confirmation du mot de passe (voici un exemple).


Pour vous montrez la page suivante on va effectué une création de compte.

	













Quand le compte est créé le login vous sera afficher en grand (comme si dessus)
Quand le compte utilisateur est créé le rôle de l’administrateur est important car l’administrateur doit validé votre compte sinon vous serai redirigé sur la page d’accueil.


PARTIE CONNEXION

Comme pour les inscriptions un va cliquer sur le bouton de connexion pour ce connecté est accédé a l’interface utilisateur.














PARTIE ADMINISTRATION

Dans la partie d’administrateur je vais vous présentez tous les pages disponibles est les fonctionnalité.
Premièrement l’administrateur a une page pour Afficher les utilisateur ce qui permet de voir les personne inscrit est les personne a autorisé sur cette page on peux voir les information des utilisateur (login, nom, prénom, e-mail).
Cette page dispose de plusieurs fonctionnalité une pour changer le rôle de l’utilisateur cette fonctionnalité est représenté par un bouton avec des personnages de couleur ( Bleu = administrateur, Vert = utilisateur, Rouge = inactif/en attente)







Sur la page on peux voir un dernier bouton qui est la corbeille en rouge ce bouton permet de supprimé les utilisateur avec un double clique (comme en dessous)


Dans cette deuxième partie je vais vous présenté la création de partie de pêche.
Cette page permet de créé des événement avec plusieurs information (le nom, le nombre de personnes max, nom de l’étang, le type de pêche, la date de l’événement, est l’horaire).
Ces information permettra un utilisateur de choisir si tous ses information lui convienne pour une potentielle réservation.


				
 




             






La prochaine fonctionnalité que je vais vous présenté est l’affichage des partie de pêche.
Cette page permet d’affiché les différente partie de pêche avec tous les informations qui on était remplit a la création d’événement juste au dessus.
Sur la page nous verrons plusieurs bouton le premier est la clé de différente couleur (Rouge = archivé les utilisateur ne voit les partie, Vert = en ligne les utilisateur voit la partie est peuvent réservé leur place).




Il reste encore 2 bouton disponible le premier est un œil celui-ci permet de voir les réservation qui on était effectué par les utilisateur.



Si un utilisateur ces trompé dans la réservation vous pourrais supprimé sa réservation avec la poubelle rouge en bout de ligne 

Est la dernier fonctionnalité disponible est la modification de la partie de pêche si l’administrateur veux modifier ou ses trompé dans une information il pourra modifier l’événement 















Sur ce site web j’ai ajouté une fonctionnalité qui est une trésorerie ce qui permet d’ajouté des (Entrée = l’argent en plus, Sortie = l’argent en moins ).
Vous avez un filtre a disposition qui est directement sélectionner sur le mois en court mes il a possibilité de choisir le mois qu’on souhaite est l’année souhaité.

















Quand vous avez choisit votre mois vous pouvez cliquer sur filtrer puis vous avec une aperçu des entré est des sortie tous en dessous il y a le total entré est total sortie qui sont affiché est qui ce met a jour des qu’une donnée est saisie dans le tableau.


Pour ajouté une donnée vous cliqué sur le bouton Ajouté une donnée.

Ce bouton vous dirige vers cette page (ci-dessus) sur cette page il vous restera a remplir les information souhaité (libellé, prix, type écriture si ses une entrée ou une sortie).

			

			










La dernier fonctionnalité pour l’administrateur est le CMS (Système de gestion de contenu ou Content Management System).
Cette fonctionnalité permet de modifier les photos qui sont sur la page d’accueil du site 
				















Quand vous cliquer sur ce bouton vous serais redirigé sur cette page (ci-dessous)





Il vous restera plus cas sélectionné les photo que vous souhaité changer est de cliquer sur le bouton téléchargé l’images.




PARTIE UTILISATEUR

Après que l’administrateur est accepté utilisateur la personne n’a plus cas ce connecté elle tombera sur une interface simple avec 2 bouton 








La premier fonctionnalité est afficher les événements ce qui permet a l’utilisateur de choisir la partie qui l’intéresse est de pouvoir reverser en cliquant sur (Je réserve mes place).

Après avoir cliquer sur le bouton vous serais redirigé vers la page de réservation ou il restera plus cas choisir le nombres de place que l’utilisateur souhaite réserver



Puis la seconde fonctionnalité disponible pour les utilisateur est les administrateur est la gestion du compte cette fonctionnalité permet de modifier le mot de passe.




                                  






PARTIE SERVEUR

Le site web est la base de donnée sont héberger sur un VPS (serveur privé virtuel).
Dans ce serveur les sites web sont placés dans des conteneur (LXC),pour la redirection sur les conteneurs souhaité j’ai donc ajouté un conteneur HAPROXY qui permet de faire la redirection vers le site souhaité selon le nom de domaine que l’on indique.                        
  








Voici la configuration réalisé sur le Haproxy, j’ai installer MariaDB pour intégré la base de donnée qui est importé en même temps que tous le reste du projet.
 

Pour la configurations dans le conteneur j’ai du installé apache2 puis mètre l’entièreté du projet dans le /var /www /html dans le fichier j’ai supprimé l’index de apache pour la remplacé par la mienne est j’ai importé mon projet garce a yafc j’ai était chercher mon zip sur un ftp que j’ai dézippé dans le répertoire.




Sur le serveur j’ai aussi mis en place des sauvegarde automatique avec un crontab le script sauvegarde 1 fois par mois l’entièreté des pages web qui l’envoie sur un ftp ses script sont réalisé avec expect se qui permet de rentré les information souhaité sans les tapé, le deuxième script réalisé 1 fois par semaine pour récupéré la base de donnée est la stocké sur le ftp.










Le configuration du crontab qui exécute les script une fois par mois et une fois par semaine.












Voici les sauvegarde qui sont dans le ftp (au dessus), voici les script est le crontab réalisé (ci-dessous).  
Voici le script qui sauvegarde la BDD








Voici le script qui sauvegarde le répertoire html. 

 
 
 
 
 
 
 

 
 
 
 
 
 
 
 

 
  
 
Voici la configuration fail2ban qui permet d’analyser un fichier le log qui est remplit a chaque connexion est qui ban selon des paramètre spéciaux 









