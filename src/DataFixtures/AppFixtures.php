<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Genre;
use App\Entity\Song;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $albums = json_decode(file_get_contents(__DIR__ . "/data/albums.json"), true);
        $artists = json_decode(file_get_contents(__DIR__ . "/data/artists.json"), true);
        $genres = json_decode(file_get_contents(__DIR__ . "/data/genres.json"), true);
        $songs = json_decode(file_get_contents(__DIR__ . "/data/songs.json"), true);

        for ($i = 0; $i < count($albums); $i++) {
            $genre = new Genre();
            $artist = new Artist();
            $album = new Album();

            $genre->setName($genres[$i]["name"]);
            $manager->persist($genre);

            $artist->setName($artists[$i]["name"])
                ->setDescription($artists[$i]["description"])
                ->setMemberNumber($artists[$i]["member_number"])
                ->setGenre($genre);
            $manager->persist($artist);

            $album->setName($albums[$i]["name"])
                ->setCreatedAt(new DateTimeImmutable($albums[$i]["created_at"]))
                ->setArtist($artist);
            $manager->persist($album);

            $song = new Song();
            $song->setName($songs[$i]["name"])
                ->setLengthSecond($songs[$i]["length_second"])
                ->setAlbum($album);
            $manager->persist($song);
        }


        $manager->flush();
    }
}
