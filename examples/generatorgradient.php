<?php
use imagemanipulation\generation\ImageGenerator;
use imagemanipulation\ImageType;
use imagemanipulation\color\Color;

ImageGenerator::gradient(500, 200, 0, new Color('#6EC5E3'), new Color('#BF2074'))
    ->render(ImageType::PNG, 80);
