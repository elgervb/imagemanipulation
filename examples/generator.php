<?php

use imagemanipulation\generation\ImageGenerator;
use imagemanipulation\ImageType;
use imagemanipulation\color\Color;

ImageGenerator::create(500, 200, new Color('#747474'))
    ->imageoutput(null, ImageType::PNG, 80);
