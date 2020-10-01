<?php


namespace App\Traits;


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

    private static string $defaultThumbConversation = 'thumb';  # для получения миниатюр изображения.

    private static int $defaultWidthPreview = 800;
    private static int $defaultHeightPreview = 450;

    /**
     * Устанавливаем атрибут изображения.
     *
     * @param $path
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
     */
    private function syncMedia($pathValue, string $collectionName)
    {
        $this->createSingleMedia($pathValue);
    }

    /**
     * Создание одного изображения с удалением предыдущих изображений
     *
     * @param $file
     * @return mixed
     */
    private function createSingleMedia($file)
    {
        $this->clearMediaCollection(static::$defaultCollection);
        return $this->addMedia($file)->toMediaCollection(static::$defaultCollection);
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
