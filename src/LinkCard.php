<?php

namespace App\Render;

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imageUrl;
    private array $tags;

    public function __construct(
        string $url = 'https://appweb-i-game.com.cn',
        string $title = '爱游戏',
        string $description = '发现更多精彩游戏内容，尽在爱游戏平台',
        string $imageUrl = '',
        array $tags = ['游戏', '娱乐', '爱游戏']
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->tags = $tags;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImageUrl = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $tagsHtml = '';
        foreach ($this->tags as $tag) {
            $escapedTag = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $tagsHtml .= '<span class="link-card-tag">' . $escapedTag . '</span>';
        }

        $imageHtml = '';
        if ($escapedImageUrl !== '') {
            $imageHtml = '<img src="' . $escapedImageUrl . '" alt="' . $escapedTitle . '" class="link-card-image">';
        }

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer" class="link-card-link">';
        if ($imageHtml !== '') {
            $html .= $imageHtml;
        }
        $html .= '<div class="link-card-content">';
        $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
        $html .= '<p class="link-card-description">' . $escapedDescription . '</p>';
        if ($tagsHtml !== '') {
            $html .= '<div class="link-card-tags">' . $tagsHtml . '</div>';
        }
        $html .= '<span class="link-card-url">' . $escapedUrl . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    public static function createDefaultCard(): self
    {
        return new self(
            'https://appweb-i-game.com.cn',
            '爱游戏',
            '欢迎来到爱游戏，海量游戏任你挑选',
            '',
            ['热门', '推荐', '爱游戏']
        );
    }

    public static function createCustomCard(string $url, string $title, string $description, string $imageUrl = '', array $tags = []): self
    {
        return new self($url, $title, $description, $imageUrl, $tags);
    }
}