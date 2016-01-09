<?php

namespace Storage;

interface Persistence { public function persist($key, $object); }