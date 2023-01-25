<?php

namespace App\DTO;

use App\Models\News;
use Spatie\DataTransferObject\DataTransferObject;

class NewsDTO extends DataTransferObject
{
  public readonly ?string $title;
  public readonly ?string $content;
  public readonly ?string $slug;
  public readonly ?string $thumbnail;
  public readonly ?int $user_id;
  public readonly ?int $category_id;

  public static function make(News $model): self
  {
      return new self([
          'title' => $model->title ?? null,
          'content' => $model->content ?? null,
          'slug' => $model->slug ?? null,
          'thumbnail' => $model->thumbnail ?? null,
          'user_id' => $model->user_id ?? null,
          'category_id' => $model->category_id ?? null,
      ]);
  }
}
