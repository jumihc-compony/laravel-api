<?php
/**
 * User: YL
 * Date: 2019/10/22
 */

namespace Jmhc\Restful\Console\Commands;

use Symfony\Component\Console\Input\InputOption;

class MakeControllerCommand extends MakeCommand
{
    /**
     * 命令名称
     * @var string
     */
    protected $name = 'jmhc-api:make-controller';

    /**
     * 实体名称
     * @var string
     */
    protected $entityName = 'Controller';

    /**
     * 获取生成内容
     * @param string $name
     * @return string
     */
    protected function getBuildContent(string $name)
    {
        $str = <<< EOF
<?php
namespace %s;

use Jmhc\Restful\Controllers\BaseController;

class %s extends BaseController
{}
EOF;
        return sprintf($str, $this->namespace, $name);
    }

    /**
     * 获取选项
     * @return array
     */
    protected function getOptions()
    {
        $options = parent::getOptions();

        return array_merge($options, [
            ['model', null, InputOption::VALUE_NONE, 'Generate the model file with the same name'],
            ['service', null, InputOption::VALUE_NONE, 'Generate the service file with the same name'],
        ]);
    }
}