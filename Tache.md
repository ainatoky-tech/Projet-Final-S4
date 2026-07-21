# Thème
Ce sera un système qui va simuler un opérateur de mobile money

## Version 1
* Coté opérateur
    - Configuration des préfixes valable de l’opérateur (ex: 033 et 037)
    - Création de types d'opérations (dépôt, retrait, transfert) avec des barèmes de frais par tranche de montant (modifiable ) . 
    - voici 1 exemple
    ![alt text](image.png)
    - Situation gain via les différents frais ( retrait et transfert)
    - Situation des comptes clients 
* Coté client
    - Login automatique avec le numéro de téléphone
    - pas d’inscription au préalable
    - Opérations
    - voir le solde
    - faire un dépot ( supposer que c’est automatique)
    - faire un retrait  ( supposer que c’est automatique)
    - faire un transfert
    - voir les historiques


>_Livraison à 13h ( mettre Tag v1)_


### Tache pour 4034:
**V1:** 
- préparation de la structure du projet :fait
- remplissage du formulaire demandé : fait
- préparation de la database dans writable en .sqlite: fait
- initialisation des models : fait 
- utilisation des migrations pour les tables : fait


### Tache pour 4075:
**V2:**
- compréhension du sujet : fait
- changement de la base : fait
- creation des fichiers de migrations : fait
- creation des fichier seeds : fait
- mise en place de la logique transfere vers autre operateur dans controller : fait

# alea 2
il y a une notion d'epargne
le client a une interface qui dicte que son epargne est de n%
imaginons qu'il dit qu'il veut epargner 50%
tout pognon entrant en transfert 50% entre dans la base de donne
les 50% restant entre dans sa solde 
ce truc se fait pour chaque client

