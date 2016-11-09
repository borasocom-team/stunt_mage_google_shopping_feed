<?php

class Stuntcoders_GoogleShopping_Model_Observer
{
    public function setFeeds()
    {
        $feeds = Mage::getModel('stuntcoders_googleshopping/feed')->getCollection();

        foreach ($feeds as $feed) {
            //$feedModel = Mage::getModel('stuntcoders_googleshopping/feed')->load($feed->getId());
            $file = new Varien_Io_File();
            $file->mkdir(dirname($feed->getPath()), 755, true);
            if($file->fileExists($feed->getPath())){
                if($file->isWriteable($feed->getPath())){
                    $file->filePutContent('',$feed->getPath());
                }
            }
            $file->write($feed->getPath(), $feed->generateXml());
        }
    }
}