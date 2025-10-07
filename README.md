# Sistema di Prenotazione Campi da Calcetto

Un'applicazione web per la gestione delle prenotazioni dei campi da calcetto. Questo sistema permette agli utenti di
visualizzare i campi disponibili, effettuare prenotazioni e gestire le proprie prenotazioni.

## Funzionalità

- Autenticazione utenti (login/logout)
- Visualizzazione campi disponibili
- Prenotazione campi
- Visualizzazione dettagli del campo inclusa la capienza
- Controllo prenotazioni esistenti
- Prevenzione di prenotazioni duplicate nella stessa data

## Installazione

1. Clona il repository
2. Configura il tuo web server (Apache/Nginx) per servire i file PHP
3. Crea un database MySQL
4. Importa lo schema del database fornito
5. Aggiorna la configurazione del database nel file `database.php`

## Utilizzo

1. Visita la homepage per vedere i campi disponibili
2. Effettua il login per fare prenotazioni
3. Seleziona un campo e scegli una data disponibile
4. Invia il modulo di prenotazione
5. Visualizza le tue prenotazioni nel tuo profilo

## Configurazione Database

Il sistema richiede un database MySQL con le seguenti tabelle:

- `utenti`
- `campi`
- `prenotazioni`

Assicurati di configurare i parametri di connessione al database nel file `database.php`.
