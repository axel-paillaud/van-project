<?php

namespace Lib\Post;
use Exception;
use Model\Tag\TagRepository;
use Model\Image\ImageRepository;
require_once base_path('src/model/image.php');

class Image {
    public string $name;
    public string $type;
    public string $tmpName;
    public int $error;
    public int $size;
}

// To insert image in database, we only need name and image url;
class ImageDb {
    public string $name;
    public string $imgUrl;
}

class Post {
    public string $title;
    public string $content;
    public array $tags;
}

class PostLib {
    public function sortFiles($files) {
        $images = [];

        for ($i = 0; $i < count($files["name"]); $i++) {
            $image = new Image();

            $image->name = $files["name"][$i];
            $image->type = $files["type"][$i];
            $image->tmpName = $files["tmp_name"][$i];
            $image->error = $files["error"][$i];
            $image->size = $files["size"][$i];

            $images[] = $image;
        }
        return $images;
    }

    public function createPostDirIfNotExist($targetDir, $user, $dirName) {
        if (!is_dir($targetDir)) {
            if (!is_dir("assets/images/users/" . $user["user_name"])) {
                mkdir("assets/images/users/" . $user["user_name"], 0700);
            }
            mkdir("assets/images/users/" . $user["user_name"]  . "/$dirName", 0700);
        }
    }

    public function addImgToServer(array $images, array $user, string $dirName) : array {
        $targetDir = "assets/images/users/" . $user["user_name"] . "/$dirName/";
        $this->createPostDirIfNotExist($targetDir, $user, "answers_images");

        $imagesDb = [];
        
        for ($i = 0; $i < count($images["name"]); $i++)
        {
            $image = new ImageDb();
            $imageType = exif_imagetype($images["tmp_name"][$i]);
            $extension = image_type_to_extension($imageType, true);
            $filename = $user["user_name"] . uniqid() . $extension;

            while (file_exists($targetDir . $filename)) { // While the filename exists (little chance), generate new name
                $filename = $user["user_name"] . uniqid() . $extension;
              }

            $image->name = $filename;
            $image->imgUrl = $targetDir . $filename;
            $imagesDb[] = $image;
            move_uploaded_file($images["tmp_name"][$i], $targetDir . $filename); // move the file to the user directory
        }
        return $imagesDb;
    }
}

function submit_post(string $title, string $content, string $tags) {
    if (empty($title) || empty($content) || empty($tags)) {
        throw new Exception("Erreur : Un des champs est vide.");
    }
    else {
        $tagRepository = new TagRepository();
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $arr_tags = $tagRepository->computeTags($tags);

        $tagRepository->addTags($arr_tags);

        $message = "Votre question a bien été publiée.";
        return $message;
    }
}