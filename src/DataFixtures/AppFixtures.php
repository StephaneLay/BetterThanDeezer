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
        $dataAlbums = json_decode(file_get_contents(__DIR__ . "/data/albums.json"), true);
        $dataArtists = json_decode(file_get_contents(__DIR__ . "/data/artists.json"), true);
        $dataGenres = json_decode(file_get_contents(__DIR__ . "/data/genres.json"), true);
        $dataSongs = json_decode(file_get_contents(__DIR__ . "/data/songs.json"), true);

        $albums = [];
        $artists = [];
        $genres = [];

        foreach ($dataGenres as $genreline) {
            $genre = new Genre();
            $genre->setName($genreline["name"]);
            $manager->persist($genre);
            $genres[] = $genre;
        }

        foreach ($dataArtists as $artistLine) {
            $artist = new Artist();
            $artist->setName($artistLine["name"])
                ->setDescription($artistLine["description"])
                ->setMemberNumber($artistLine["member_number"])
                ->setGenre($genres[$artistLine["genre_id"]-1]);
            $manager->persist($artist);
            $artists[] = $artist;
        }

        foreach ($dataAlbums as $albumLine) {
            $album = new Album();
            $album->setName($albumLine["name"])
            ->setCreatedAt(new DateTimeImmutable($albumLine["created_at"]))
            ->setArtist($artists[$albumLine["artist_id"]-1]);
            $manager->persist($album);
            $albums[] = $album;
        }

        foreach ($dataSongs as $songLine) {
            $song = new Song();
            $song->setName($songLine["name"])
            ->setLengthSecond( $songLine["duration"])
            ->setAlbum($albums[$songLine["album_id"]-1]);
            $manager->persist($song);
            
        }

        $manager->flush();
    }
}
