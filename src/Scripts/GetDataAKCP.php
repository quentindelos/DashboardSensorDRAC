<?php
// Adresse IP de l'appareil SNMP
$ip = '192.168.112.15';

// Communauté SNMP (utilisé pour SNMPv1 et SNMPv2c)
$community = 'public'; // Changez la communauté si nécessaire

// OID que vous souhaitez interroger
$oid = '.1.3.6.1.4.1.3854.3.5.4.1.6.0.0.0.1.0';

// Utilisation de snmpget pour récupérer la valeur de l'OID
$result = snmpget($ip, $community, $oid);

if ($result === false) {
    echo "Erreur lors de la récupération des données SNMP.";
} else {
    // Nettoyer le résultat en supprimant le type de données (par exemple, STRING:)
    $cleanedResult = preg_replace('/^.*: /', '', $result);
    echo "Valeur de l'OID $oid : $cleanedResult";
}
?>