<?php

namespace Task\Services\Mapper;

interface IMapperService
{
	public function map($source, $destinationType, bool $jsonEncoded = false);

	public function maps($sources, $destinationType);
}