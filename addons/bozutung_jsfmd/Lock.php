<?php
/**
 * 深蓝网络 Copyright (c) www.zhshenlan.com
 */

interface Lock
{
	function lock();

	function tryLock($until = true);

	function unlock();

	function clean();
}

class FileLock implements Lock
{
	private $fp;
	private $filename;

	function __construct($fileName)
	{
		$dir = dirname($fileName);
		if (!file_exists($dir)) {
			mkdir($dir);
		}
		$this->filename = $fileName;
		$this->fp = fopen($fileName, 'w+');
	}

	function lock()
	{
		return flock($this->fp, LOCK_EX);
	}

	function tryLock($until = true)
	{
		return flock($this->fp, LOCK_NB | LOCK_EX);
	}

	function unlock()
	{
		flock($this->fp, LOCK_UN);
	}

	function clean()
	{
		unlink($this->filename);
	}
}

/**
 * 按照传入文件的顺序，获取文件锁
 */
class MultiFileLock implements Lock
{
	private $files;
	private $fileNames;

	function __construct(array $files)
	{
		$this->fileNames = $files;
		foreach ($files as $f) {
			$dir = dirname($f);
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			$fileHandles[] = fopen($f, 'w+');
		}
		$this->files = $fileHandles;
	}

	function tryLock($until = true)
	{
		$files = $this->files;
		$size = count($files);
		do {
			$failure = false;
			for ($i = 0; $i < $size; ++$i) {
				if (!flock($files[$i], LOCK_NB | LOCK_EX)) {
					$failure = true;
					for ($j = 0; $j < $i; ++$j) {
						flock($files[$j], LOCK_UN);
					}
					break;
				}
			}
			if (!$failure) break;
		} while ($until);
		return !$failure;
	}

	function unlock()
	{
		$files = $this->files;
		$size = count($files);
		for ($i = $size - 1; $i > -1; --$i) {
			flock($files[$i], LOCK_UN);
		}
	}

	function clean()
	{
		foreach ($this->fileNames as $fn) {
			unlink($fn);
		}
	}

	function lock()
	{
		foreach ($this->files as $f) {
			flock($f, LOCK_EX);
		}
	}
}
