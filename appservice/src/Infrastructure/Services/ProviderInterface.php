<?php
namespace Evento\Infrastructure\Services;

interface ProviderInterface
{
    public function getContent(array $criteria);
}