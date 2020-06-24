<?php


namespace History\Repositories;


use History\Model\History;
use Prettus\Repository\Eloquent\BaseRepository;

class HistoryRepositories extends BaseRepository
{
    public function model()
    {
        return History::class;
    }
    public function createHistory($data){
        try{
            $this->create($data);
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

}