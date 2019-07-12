<?php 
class Temperatur extends DB{
// Variablenliste
    public $station;
    public $timestamp;
    public $ts;
    public $Luftdruck;
    public $temp5;
    public $temp20;
    public $feuchte;
    public $taupunkt;
    public $quality;

    public $dataMapping=array(
        'station'=>'station',
        'timestamp'=>'timestamp',
        'Luftdruck'=>'Luftdruck',
        'temp5'=>'temp5',
        'temp20'=>'temp20',
        'feuchte'=>'feuchte',
        'taupunkt'=>'taupunkt',
        'quality'=>'quality');
// Konstanten
    const SQL_INSERT='INSERT INTO Temperatur (station, timestamp, Luftdruck, temp5, temp20, feuchte, taupunkt, quality) VALUES (?,?,?,?,?,?,?,?)';
    const SQL_UPDATE='UPDATE Temperatur SET station=?, timestamp=?, Luftdruck=?, temp5=?, temp20=?, feuchte=?, taupunkt=?, quality=? WHERE =?';
    const SQL_SELECT_PK='SELECT * FROM Temperatur WHERE =?';
    const SQL_SELECT_ALL='SELECT * FROM Temperatur';
    const SQL_DELETE='DELETE FROM Temperatur WHERE =?';

    public $validateMapping=array(
        'station'=>'FILTER_VALIDATE_INT',
        'timestamp'=>'FILTER_VALIDATE_INT',
        'Luftdruck'=>'FILTER_VALIDATE_FLOAT',
        'temp5'=>'FILTER_VALIDATE_FLOAT',
        'temp20'=>'FILTER_VALIDATE_FLOAT',
        'feuchte'=>'FILTER_VALIDATE_FLOAT',
        'taupunkt'=>'FILTER_VALIDATE_FLOAT',
        'quality'=>'FILTER_VALIDATE_INT'
    );

    public $sanitizeMapping=array(
        'station'=>'FILTER_SANITIZE_NUMBER_INT',
        'timestamp'=>'FILTER_SANITIZE_NUMBER_INT',
        'Luftdruck'=>'FILTER_SANITIZE_NUMBER_FLOAT',
        'temp5'=>'FILTER_SANITIZE_NUMBER_FLOAT',
        'temp20'=>'FILTER_SANITIZE_NUMBER_FLOAT',
        'feuchte'=>'FILTER_SANITIZE_NUMBER_FLOAT',
        'taupunkt'=>'FILTER_SANITIZE_NUMBER_FLOAT',
        'quality'=>'FILTER_SANITIZE_NUMBER_INT'
    );
}