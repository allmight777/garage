<?php

if (!function_exists('getColor')) {
    function getColor($index)
    {
        $colors = [
            '#1e40af', // Bleu foncé
            '#16a34a', // Vert
            '#dc2626', // Rouge
            '#d97706', // Orange
            '#7c3aed', // Violet
            '#0891b2', // Bleu clair
        ];

        return $colors[$index % count($colors)];
    }
}
