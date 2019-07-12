<?php 
class Stationen extends DB{
// Variablenliste
    public $id;
    public $name;

    public $dataMapping=array(
        'id'=>'id',
        'name'=>'name');
// Konstanten
    const SQL_INSERT='INSERT INTO Stationen (id, name) VALUES (?,?)';
    const SQL_UPDATE='UPDATE Stationen SET name=? WHERE id=?';
    const SQL_SELECT_PK='SELECT * FROM Stationen WHERE id=?';
    const SQL_SELECT_ALL='SELECT * FROM Stationen';
    const SQL_DELETE='DELETE FROM Stationen WHERE id=?';
    const SQL_PRIMARY='id';

    public $validateMapping=array(
        'id'=>'FILTER_VALIDATE_INT'
    );

    public $sanitizeMapping=array(
        'id'=>'FILTER_SANITIZE_NUMBER_INT'
    );
}