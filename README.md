-V1.0



- Aplikacija je napravljena u Laravelu, Bootsrapu i JavaScriptu
- Logika samog zadatka je unaprijeđena, te je na istu dodan eloquent model za autentifikaciju. To nam dozvoljava da svaki korisnik vidi i dodaje informacije SAMO O SEBI
- Za uspješno pokretanje potrebno pokrenuti migraciju baze i seedere. Nakon toga, seederi će napraviti demo data (jednog usera - podaci za login admin@example.com, Admin1234!, te nekoliko recorda u bazi za izostanke)
- Ako budete imali problema sa migracijom ili seederima, bazu možete preuzeti na linku https://drive.google.com/file/d/1HZ5jv6HaR2LKZtdALB8vu4nbirqHN55M/view?usp=drive_link
- Na kraju, sama registracija (dodavanje korisnika) je moguća. Testni podaci su napravljeni samo u svrhu lakšeg pregleda valjanosti




- V2.0




- Zadatak 1:
Vikendi naznačeni drugim bojama
Kalendar je generisan JavaScriptom. 


Zadatak 2.1: 
       ER dijagram generisan https://github.com/kulasin/teneo/blob/main/ER-diagram.pdf
       Za kvalitetno pokretanje zadatka, izbrisati sve što ste imali prije, te pokrenuti migraciju i seedere ponovo (php artisan migrate i php artisan db:seed).


Zadatak 2.2.:
       Za registraciju odsustva se koristi Axios poziv.
       Kod registracije odsustava, lista istih implementirana kao šifrarnik.


Zadatak 3:
      Urađeno u V1

Zadatak 4.1:
      Validacija za sprječavanje 7+ dana bolovanja u mjesecu i odmor vikendima napravljena

Zadatak 4.2:
     Integrisana opcija data range sa opcionalnim izborom end datuma

Zadatak 5:
      Tabela reg_archive napravljena, kao i logika za spašavanje i izbjegavanje spašavanje istih podataka dva puta (dupliciranja)
      Napravljen forntend u obliku DataTables.js plugina koji omogućava paginaciju (moguća je bila i kroz Laravel), filere, sortiranja, pretragu itd
