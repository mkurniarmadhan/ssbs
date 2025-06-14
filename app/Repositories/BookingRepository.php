<?php

namespace App\Repositories;

use Core\DB;
use Domain\Booking;
use PDO;

class BookingRepository
{
    public function all(array $filter=[],int $limit = 50, int $offset = 0): array
    {

         $q = "SELECT * FROM bookings WHERE 1=1";
         $params = [];


         if(!empty($filter['name'])){
             $q .= "AND name like :name";
             $params['user']= '%'.$filter['name'].'%';
         } if(!empty($filter['email'])){
             $q .= "AND email like :email";
             $params['email']= '%'.$filter['email'].'%';
         }

         $q .= "ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = DB::getConnection()->prepare($q);
        foreach ($params as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create(Booking $booking): bool
  {
    $stmt = DB::getConnection()->prepare(query: "
            INSERT INTO bookings (name, email, date)
            VALUES (:name, :email, :date)
        ");
    return $stmt->execute([
      'name' => $booking->name,
      'email' => $booking->email,
      'date' => $booking->date,
    ]);
  }


  public  function update($id, array $data): bool
    {

        $smt = DB::getConnection()->prepare(query: "UPDATE bookings SET name =:name ,email=:email , data=:date WHERE id=:id ");
        return $smt->execute([
            'id'=> $id,
            'name'=>$data['name'],
            'email'=>$data['email']        ]);
  }
  public function show(int $id): ?array{
$smt = DB::getConnection()->prepare("SELECT * FROM bookings WHERE id=:id");
$smt->execute(['id'=>$id]);
return  $smt->fetch() ?: null;
  }

  public function  destroy(int $id):bool

  {
$smt= DB::getConnection()->prepare("DELETE FROM bookings WHERE id=:id");
return  $smt->execute(['id'=>$id]);
  }
}
