INDX( 	 ��}�           (   8   �       . �   .  rc                        >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 x f     >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k  p h p                 ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 >�
    ����o� ��w�[ Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 x f     >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 x f     >�
    ����o� ��w�[�Z�Ȧo��0��o�       �               p l a t f o r m _ c h e c k . p h p                 or/leafo/scssphp-compass/compass.inc.php';
        $this->sassHandler->enableCompass = true;
        $scssFile = $this->fixturesDirectory . 'compass.scss';
       $this->assertEquals(
            'div{filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=10);opacity:0.1}',
            $this->sassHandler->compile($scssFile)
        );
    }

    public function testGetCompiledFile()
    {
        $sourcePath = $this->fixturesDirectory . 'import.scss';
        $compiledPath = $this->sassHandler->getCompiledFile($sourcePath);
        $expectedPath = Yii::getPathOfAlias($this->sassHandler->sassCompiledPath)
            . DIRECTORY_SEPARATOR . 'import-'
             substr(md5($sourcePath), -8)
            . '.css';

        $this->assertEquals($expectedPath, $compiledPath);
        $this->assertEquals(
            'body a{color:red}',
            file_get_contents($compiledPath)
        );
    }

    public function testGetCompiledFileWithoutRecompilation()
    {
        $sourcePath = $this->fixturesDirectory . 'import.scss';

        // First compilation request
        $this->sassHandler->getCompiledFile($sourcePath);

        // Second compilation request
       $compiledPath = $this->sassHandler->getCompiledFile($sourcePath);

        $expectedPath = Yii::getPathOfAlias($this->sassHandler->sassCompiledPath)
            . DIRECTORY_SEPARATOR . 'import-'
            . substr(md5($sourcePath), -8)
            . '.css';

        $this->assertEquals($expectedPath, $compiledPath);
        $this->assertEquals(
            'body a{color:red}',
            file_get_contents($compiledPath)
        );
    }

    public function testEmptyFileCompilation()
    {
        $sou ePath = $this->fixturesDirectory . 'empty.scss';
        $this->assertNotEmpty($this->sassHandler->getCompiledFile($sourcePath));
    }
}
