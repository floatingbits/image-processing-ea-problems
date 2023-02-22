<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

enum ModifierEnum
{
    case OriginCoordinateModifier;
    case FillColorModifier;
    case StrokeColorModifier;
    case RadiusModifier;
}