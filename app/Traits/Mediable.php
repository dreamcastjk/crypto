<?php


namespace App\Traits;


use Spatie\MediaLibrary\MediaCollections\Events\CollectionHasBeenCleared;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Содержит методы для переопделения методов медиа-библиотеки,
 * например позволяет загружать изображения через SleepingowlAdmin
 * в медиа-библиотеку.
 *
 * Trait Mediable
 * @package App\Traits
 */
trait Mediable
{
    public static string $defaultCollection = 'image';  # стандартная коллекция для изображений модели.
    public static string $productCollection = 'product';  # коллекция изображений продукта

    private static string $defaultThumbConversation = 'thumb';  # для получения миниатюр изображения.

    private static int $defaultWidthPreview = 800;
    private static int $defaultHeightPreview = 450;

    /**
     * Устанавливаем атрибут изображения.
     *
     * @param $path
     * @throws \Exception
     */
    public function setImageAttribute($path)
    {
        $this->syncMedia($path, static::$defaultCollection);
    }

    /**
     * Получаем ссылку на изображение.
     *
     * @return mixed
     */
    public function getImageAttribute()
    {
        /* @var MediaCollection $media */
        $media = $this->getMedia(static::$defaultCollection);

        if ($media->count() > 1) {
            $images = [];
            /* @var Media $mediaItem */
            foreach ($media as $mediaItem) {
                $images[] = $mediaItem->getUrl();
            }

            return $images;
        }

        return $this->getFirstMediaUrl(static::$defaultCollection);
    }

    /**
     * Получаем превью изображения.
     *
     * @return mixed
     */
    public function getPreviewAttribute()
    {
        $media = $this->getFirstMedia(static::$defaultCollection);
        return optional($media)->getUrl(static::$defaultThumbConversation);
    }

    /**
     * Синхронизация медиа файлов по нужным правилам.
     *
     * @param $pathValue
     * @param string $collectionName
     * @throws \Exception
     */
    private function syncMedia($pathValue, string $collectionName)
    {
        if (empty($pathValue)) {
            $this->clearMediaCollection($collectionName);
            return;
        }

        $values = [];
        if (is_string($pathValue)) {
            $values[] = $pathValue;
        } else {
            $values = $pathValue;
        }

        /* @var MediaCollection $media */
        $media = $this->getMedia($collectionName);

        /* @var Media $mediaItem */
        foreach ($media as $mediaItem) {
            foreach ($values as $key => $value) {
                if ($mediaItem->getUrl() == $value) {
                    unset($values[$key]);
                    continue 2;
                }
            }
            $mediaItem->delete();
            event(new CollectionHasBeenCleared($this, $collectionName));

            if ($this->mediaIsPreloaded()) {
                unset($this->media);
            }
        }

        foreach ($values as $value) {
            $this->createSingleMedia($value, $collectionName);
        }
    }

    /**
     * Создание одного изображения с удалением предыдущих изображений
     *
     * @param $file
     * @param $collectionName
     */
    private function createSingleMedia($file, $collectionName)
    {
        if (filter_var($file, FILTER_VALIDATE_URL)) {
            $this->addMediaFromUrl($file)->toMediaCollection($collectionName);
        } else {
            $this->addMedia($file)->toMediaCollection($collectionName);
        }
    }

    /**
     * Миниатюра изображения
     *
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(static::$defaultThumbConversation)
            ->width(static::$defaultWidthPreview)
            ->height(static::$defaultHeightPreview);
    }
}
