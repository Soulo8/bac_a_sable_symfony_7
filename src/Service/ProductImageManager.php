<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

final class ProductImageManager
{
    public function __construct(
        private UploaderHelper $uploaderHelper,
    ) {
    }

    /**
     * @return array<array<int|string>>
     */
    public function getImagesData(Product $product): array
    {
        $data = [];
        $images = $product->getImages();
        foreach ($images as $key => $image) {
            $data[] = [
                'index' => $key,
                'name' => $image->getImageName(),
                'url' => $this->uploaderHelper->asset($image, 'imageFile'),
            ];
        }

        return $data;
    }

    public function updatePosition(Request $request, Product $product): void
    {
        if ($request->request->has('product')) {
            $data = $request->request->all()['product'];
            if (array_key_exists('images', $data)) {
                $positions = array_flip(array_keys($data['images']));
                $images = $product->getImages();
                foreach ($images as $key => $image) {
                    if (array_key_exists($key, $positions)) {
                        $image->setPosition($positions[$key]);
                    }
                }
                $product->sortImagesByPosition();
            }
        }
    }
}
