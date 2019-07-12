<?php 
class Datapoints extends DB{
// Variablenliste

    public $dataMapping=array(
);
// Konstanten
    const SQL_INSERT='INSERT INTO Datapoints () VALUES ()';
    const SQL_UPDATE='UPDATE Datapoints SET  WHERE =?';
    const SQL_SELECT_PK='SELECT * FROM Datapoints WHERE =?';
    const SQL_SELECT_ALL='SELECT * FROM Datapoints';
    const SQL_DELETE='DELETE FROM Datapoints WHERE =?';

    public $validateMapping=array(

    );

    public $sanitizeMapping=array(

    );
}