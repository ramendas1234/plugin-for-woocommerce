<?php
// Price comparison trait
trait PriceComparison {
    public function comparePrices($price1, $price2) {
        return $price1 - $price2;
    }
}