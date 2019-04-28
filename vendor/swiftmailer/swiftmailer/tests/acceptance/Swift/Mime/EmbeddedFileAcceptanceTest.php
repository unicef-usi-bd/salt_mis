<?php

use Egulias\EmailValidator\EmailValidator;

class Swift_Mime_EmbeddedFileAcceptanceTest extends \PHPUnit\Framework\TestCase
{
    private $contentEncoder;
    private $cache;
    private $headers;
    private $emailValidator;

    protected function setUp()
    {
        $this->cache = new Swift_KeyCache_ArrayKeyCache(
            new Swift_KeyCache_SimpleKeyCacheInputStream()
            );
        $factory = new Swift_CharacterReaderFactory_SimpleCharacterReaderFactory();
        $this->contentEncoder = new Swift_Mime_ContentEncoder_Base64ContentEncoder();

        $headerEncoder = new Swift_Mime_HeaderEncoder_QpHeaderEncoder(
            new Swift_CharacterStream_CharacterStream($factory, 'utf-8')
            );
        $paramEncoder = new Swift_Encoder_Rfc2231Encoder(
            new Swift_CharacterStream_CharacterStream($factory, 'utf-8')
            );
        $this->emailValidator = new EmailValidator();
        $this->idGenerator = new Swift_Mime_IdGenerator('example.com');
        $this->headers = new Swift_Mime_SimpleHeaderSet(
            new Swift_Mime_SimpleHeaderFactory($headerEncoder, $paramEncoder, $this->emailValidator)
            );
    }

    public function testContentIdIsSetInHeader()
    {
        $file = $this->createEmbeddedFile();
        $file->setContentType('application/reportPdf');
        $file->setId('foo@bar');
        $this->assertEquals(
            'Content-Type: application/reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <foo@bar>'."\r\n".
            'Content-Disposition: inline'."\r\n",
            $file->toString()
            );
    }

    public function testDispositionIsSetInHeader()
    {
        $file = $this->createEmbeddedFile();
        $id = $file->getId();
        $file->setContentType('application/reportPdf');
        $file->setDisposition('attachment');
        $this->assertEquals(
            'Content-Type: application/reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <'.$id.'>'."\r\n".
            'Content-Disposition: attachment'."\r\n",
            $file->toString()
            );
    }

    public function testFilenameIsSetInHeader()
    {
        $file = $this->createEmbeddedFile();
        $id = $file->getId();
        $file->setContentType('application/reportPdf');
        $file->setFilename('foo.reportPdf');
        $this->assertEquals(
            'Content-Type: application/reportPdf; name=foo.reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <'.$id.'>'."\r\n".
            'Content-Disposition: inline; filename=foo.reportPdf'."\r\n",
            $file->toString()
            );
    }

    public function testSizeIsSetInHeader()
    {
        $file = $this->createEmbeddedFile();
        $id = $file->getId();
        $file->setContentType('application/reportPdf');
        $file->setSize(12340);
        $this->assertEquals(
            'Content-Type: application/reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <'.$id.'>'."\r\n".
            'Content-Disposition: inline; size=12340'."\r\n",
            $file->toString()
            );
    }

    public function testMultipleParametersInHeader()
    {
        $file = $this->createEmbeddedFile();
        $id = $file->getId();
        $file->setContentType('application/reportPdf');
        $file->setFilename('foo.reportPdf');
        $file->setSize(12340);

        $this->assertEquals(
            'Content-Type: application/reportPdf; name=foo.reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <'.$id.'>'."\r\n".
            'Content-Disposition: inline; filename=foo.reportPdf; size=12340'."\r\n",
            $file->toString()
            );
    }

    public function testEndToEnd()
    {
        $file = $this->createEmbeddedFile();
        $id = $file->getId();
        $file->setContentType('application/reportPdf');
        $file->setFilename('foo.reportPdf');
        $file->setSize(12340);
        $file->setBody('abcd');
        $this->assertEquals(
            'Content-Type: application/reportPdf; name=foo.reportPdf'."\r\n".
            'Content-Transfer-Encoding: base64'."\r\n".
            'Content-ID: <'.$id.'>'."\r\n".
            'Content-Disposition: inline; filename=foo.reportPdf; size=12340'."\r\n".
            "\r\n".
            base64_encode('abcd'),
            $file->toString()
            );
    }

    protected function createEmbeddedFile()
    {
        $entity = new Swift_Mime_EmbeddedFile(
            $this->headers,
            $this->contentEncoder,
            $this->cache,
            $this->idGenerator
            );

        return $entity;
    }
}
