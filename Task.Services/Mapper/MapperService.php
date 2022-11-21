<?php

namespace Task\Services\Mapper;

use Task\Services\Mapper\IMapperService;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;


class MapperService implements IMapperService
{
	private $serializer;

	public function __construct() {

		AnnotationRegistry::registerLoader('class_exists');
		
		$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
		
		$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
		
        $this->serializer = new Serializer(
            [
                new ObjectNormalizer(
                    $classMetadataFactory,
                    $metadataAwareNameConverter,
                    null, 
                    new PhpDocExtractor()),
                    new ArrayDenormalizer()],
                    ['json' => new JsonEncoder()
            ]);
	}
	
	public function map($source, $destinationType, bool $jsonEncoded = false)
	{
		if(!$jsonEncoded)
		{
			$source = json_encode($source);
		}
        
		if (!isset($source) || !isset($destinationType)) {
			return null;
		}
		
		try {
			return $this->serializer->deserialize($source, $destinationType, 'json');

		} catch(\Exception $ex) {
			
			return null;
		}
	}

	public function maps($sources, $destinationType)
	{
		if (!isset($sources) || !isset($destinationType)) {
			return [];
		}

		if (!is_string($sources)) {
		    $sources = json_encode($sources);
		}
		
		try {
			return $this->serializer->deserialize($sources, $destinationType . '[]', 'json');
		} catch(\Exception $ex) {
			dd($ex);
			return [];
		}
	}
}