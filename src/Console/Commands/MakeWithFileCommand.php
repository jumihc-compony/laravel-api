<?php
/**
 * User: YL
 * Date: 2019/11/18
 */

namespace Jmhc\Restful\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class MakeWithFileCommand extends Command
{
    /**
     * 命令名称
     * @var string
     */
    protected $name = 'jmhc-api:make-with-file';

    /**
     * 命令描述
     * @var string
     */
    protected $description = 'Generate some file with file';

    /**
     * 默认保存路径
     * @var string
     */
    protected $defaultDir = 'Http/';

    /**
     * 选项 dir
     * @var string
     */
    protected $optionDir;

    /**
     * 选项 module
     * @var string
     */
    protected $optionModule;

    /**
     * 选项 suffix
     * @var string
     */
    protected $optionSuffix;

    /**
     * 选项 controller
     * @var string
     */
    protected $optionController;

    /**
     * 是否覆盖控制器
     * @var bool
     */
    protected $isForceController;

    /**
     * 选项 service
     * @var string
     */
    protected $optionService;

    /**
     * 是否覆盖服务
     * @var bool
     */
    protected $isForceService;

    /**
     * 选项 model
     * @var string
     */
    protected $optionModel;

    /**
     * 是否覆盖模型
     * @var bool
     */
    protected $isForceModel;

    /**
     * 选项 migration
     * @var string
     */
    protected $optionMigration;

    /**
     * 选项 seeder
     * @var string
     */
    protected $optionSeeder;

    public function handle()
    {
        // 设置参数、选项
        $this->setArgumentOption();

        // 读取生成文件配置
        $tables = config('jmhc-build-file', []);

        // 数据表不存在
        if (empty($tables)) {
            $this->info('Generate Succeed!');
        }

        // 过滤名称
        $tables = $this->filterTables($tables);

        // 生成文件
        foreach ($tables as $table) {
            $this->buildFile($table);
        }

        $this->info('Generate Succeed!');
    }

    /**
     * 过滤表名
     * @param array $tables
     * @return array
     */
    protected function filterTables(array $tables)
    {
        // 数据表前缀
        $prefix = app('db.connection')->getConfig('prefix');

        return array_values(array_filter(array_unique(array_map(function ($table) use ($prefix) {
            return str_replace($prefix, '', $table);
        }, $tables))));
    }

    /**
     * 创建文件
     * @param string $name
     */
    protected function buildFile(string $name)
    {
        // 命令参数
        $arguments = [
            'name' => $name,
            '--module' => $this->optionModule,
            '--suffix' => $this->optionSuffix,
            '--dir' => $this->optionDir,
        ];

        // 创建控制器
        if ($this->optionController) {
            $arguments['force'] = $this->isForceController;
            $this->call('jmhc-api:make-controller', $arguments);
        }

        // 创建模型
        if ($this->optionModel) {
            $arguments['force'] = $this->isForceModel;
            $this->call('jmhc-api:make-model', $arguments);
        }

        // 创建服务
        if ($this->optionService) {
            $arguments['force'] = $this->isForceService;
            $this->call('jmhc-api:make-service', $arguments);
        }

        // 创建迁移
        if ($this->option('migration')) {
            try {
                $this->call('make:migration', [
                    'name' => sprintf(
                        'create_%s_table',
                        Str::plural(Str::snake($name))
                    )
                ]);
            } catch (InvalidArgumentException $e) {}
        }

        // 创建填充
        if ($this->option('seeder')) {
            $this->call('make:seeder', [
                'name' => sprintf(
                    '%sTableSeeder',
                    Str::plural(ucfirst($name))
                )
            ]);
        }
    }

    /**
     * 设置参数、选项
     */
    protected function setArgumentOption()
    {
        $this->optionDir = $this->option('dir');
        $this->optionModule = $this->option('module');
        $this->optionSuffix = $this->option('suffix');
        $this->optionController = $this->option('controller');
        $this->isForceController = $this->option('force') || $this->option('force-controller');
        $this->optionService = $this->option('service');
        $this->isForceService = $this->option('force') || $this->option('force-service');
        $this->optionModel = $this->option('model');
        $this->isForceModel = $this->option('force') || $this->option('force-model');
        $this->optionMigration = $this->option('migration');
        $this->optionSeeder = $this->option('seeder');
    }

    /**
     * 获取选项
     * @return array
     */
    public function getOptions()
    {
        return [
            ['dir', null, InputOption::VALUE_REQUIRED, 'File saving path, relative to app directory', $this->defaultDir],
            ['module', 'm', InputOption::VALUE_REQUIRED, 'Module name'],
            ['force', 'f', InputOption::VALUE_NONE, 'Overwrite existing file'],
            ['force-controller', 'fc', InputOption::VALUE_NONE, 'Overwrite existing controller file'],
            ['force-service', 'fs', InputOption::VALUE_NONE, 'Overwrite existing service file'],
            ['force-model', 'fm', InputOption::VALUE_NONE, 'Overwrite existing model file'],
            ['suffix', 's', InputOption::VALUE_NONE, sprintf('Add suffix')],
            ['controller', null, InputOption::VALUE_NONE, 'Generate the controller file with the same name'],
            ['service', null, InputOption::VALUE_NONE, 'Generate the service file with the same name'],
            ['model', null, InputOption::VALUE_NONE, 'Generate the model file with the same name'],
            ['migration', null, InputOption::VALUE_NONE, 'Generate the migration file with the same name'],
            ['seeder', null, InputOption::VALUE_NONE, 'Generate the seeder file with the same name'],
        ];
    }
}