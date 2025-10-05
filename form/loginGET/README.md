# Esempio didattico: Login via GET e download file

Questo piccolo esempio mostra un form di login che invia username e password via GET e, se l'autenticazione ha successo, permette di scaricare un file di testo (`credentials.txt`) contenente coppie utente:password in chiaro.

Attenzione: è solo un esempio didattico. Non usare GET per password in produzione e non memorizzare password in chiaro.

Come provare in locale:

1. Apri una shell nella cartella del progetto (`/home/monotask/Source/PHP/esempiPHP/form/loginGET`).
2. Avvia il server PHP built-in:

```bash
php -S 127.0.0.1:8000
```

3. Apri il browser su `http://127.0.0.1:8000/index.php`.
4. Usa una delle credenziali di esempio presenti in `credentials.txt` (ad esempio `alice` / `password123`). Dopo il login riuscito vedrai il link per scaricare il file `credentials.txt`.

File principali:
- `index.php` - form di login (GET) e logica di autenticazione.
- `download.php` - serve `credentials.txt` solo se la sessione è autenticata.
- `credentials.txt` - contiene coppie username:password in chiaro (esempio).
- `styles.css` - foglio di stile esterno semplice.

Note tecniche:
- L'autenticazione controlla `credentials.txt` riga per riga e confronta username e password esatti.
- Il download è protetto solo tramite una variabile di sessione (`$_SESSION['authenticated']`). Questo è sufficiente per l'esempio ma non per uso reale.
