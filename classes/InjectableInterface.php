<?php
namespace Rss;
/**
 * Description of InjectableInterface
 *
 * @author mike
 */
interface InjectableInterface {
    
    public function setInjectionContainer(InjectionContainer $container);
}
