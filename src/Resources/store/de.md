Dieses Plugin erweitert den Shopware 6 Flow Builder um eine Ausführungshistorie und Fehler-Tracking.

Der aktuelle Funktionsumfang besteht aus:

*   Flow-Ausführungshistorie
    *   Protokolliert jede Flow-Ausführung (Erfolg und Fehler) in einer eigenen Tabelle
    *   Fügt einen History-Tab in der Flow-Detailseite hinzu
*   Fehler-Tracking
    *   Speichert Exception-Nachricht, Datei, Zeile und Klasse fehlgeschlagener Flows
    *   Modal zur Einsicht des gespeicherten Event-Payloads und der Fehler-Details
*   Auslöser-Erkennung
    *   Erfasst, welcher Benutzer, welche Integration oder welcher Kunde den Flow ausgelöst hat
*   Automatische Bereinigung
    *   Geplanter Task entfernt alte Einträge nach konfigurierbarer Aufbewahrungszeit (Standard: 30 Tage)
*   Optionale FroshTools-Integration
    *   Fügt einen Health-Check hinzu, der fehlgeschlagene Flow-Ausführungen im System-Status meldet
    *   Aktiviert sich automatisch, wenn FroshTools installiert ist

Link to repository: [https://github.com/FriendsOfShopware/FroshFlowBuilder](https://github.com/FriendsOfShopware/FroshFlowBuilder)

Dieses Plugin wird von [@FriendsOfShopware](https://store.shopware.com/friends-of-shopware.html) entwickelt.

Bei Fragen / Fehlern bitte ein [Github Issue](https://github.com/FriendsOfShopware/FroshFlowBuilder/issues) erstellen
