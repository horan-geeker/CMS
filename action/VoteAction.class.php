<?php

/**
 * @author:Hejunwei
 *
 * @version:1.0
 *
 * @date:2016年3月24日
 *
 * 版权所有 2015-2016 http://www.majialichen.com
 *
 */
class VoteAction extends Action
{
    public function __construct(&$_tpl)
    {
        parent::__construct($_tpl, new VoteModel());
    }


    public function action()
    {
        //业务流程控制器
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'show':
                    $this->show();
                    break;
                case 'add':
                    $this->add();
                    break;
                case 'addChild':
                    $this->addChild();
                    break;
                case 'showChild':
                    $this->showChild();
                    break;
                case 'update':
                    $this->update();
                    break;
                case 'delete':
                    $this->del();
                    break;
                default:
                    Tool::alertBack('非法操作');
            }
        } else {
            Tool::alertBack('非法操作');
        }
    }


    private function show()
    {
        parent::page($this->_model->getVoteTotal());
        $this->_tpl->assign('title', '投票主题');
        $this->_tpl->assign('show', true);
        $this->_tpl->assign('votes',$this->_model->getAllVote());
    }

    private function showChild()
    {
        if(isset($_GET['vid'])){
            $this->_model->vid = $_GET['vid'];
            parent::page($this->_model->getChildVoteTotal());
            $this->_tpl->assign('title', '投票项目列表');
            $this->_tpl->assign('vid', $this->_model->vid);
            $this->_tpl->assign('showChild', true);
            $this->_tpl->assign('childVotes',$this->_model->getAllChildVote());
        }
    }

    private function add()
    {
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['title'])){
                Tool::alertBack('名称不得为空');
            }
            if(Validate::checkLength($_POST['title'], 2,'min')){
                Tool::alertBack('名称不得小于2位');
            }
            if(Validate::checkLength($_POST['title'], 20,'max')){
                Tool::alertBack('名称不得大于20位');
            }
            if(Validate::checkLength($_POST['info'], 200,'max')){
                Tool::alertBack('描述不得大于200位');
            }
            $this->_model->title = $_POST['title'];
            $this->_model->info = $_POST['info'];
            $this->_model->addVote()?Tool::alertLocation(null,'?action=show'):Tool::alertBack('新增失败');
        }

        $this->_tpl->assign('add', true);
        $this->_tpl->assign('title', '新增投票主题');
    }

    private function addChild()
    {
        if(isset($_GET['id'])){
            $this->_model->id = $_GET['id'];
            if(!$vote = $this->_model->getOneVote()){
                Tool::alertBack('不存在此主题');
            }
            $this->_tpl->assign('addChild', true);
            $this->_tpl->assign('id', $this->_model->id);
            $this->_tpl->assign('title', '新增投票主题');
            $this->_tpl->assign('titleParent', $vote->title);
        }
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['title'])){
                Tool::alertBack('名称不得为空');
            }
            if(Validate::checkNull($_POST['id'])){
                Tool::alertBack('id非法');
            }
            if(Validate::checkLength($_POST['title'], 2,'min')){
                Tool::alertBack('名称不得小于2位');
            }
            if(Validate::checkLength($_POST['title'], 20,'max')){
                Tool::alertBack('名称不得大于20位');
            }
            if(Validate::checkLength($_POST['info'], 200,'max')){
                Tool::alertBack('描述不得大于200位');
            }
            $this->_model->vid = $_POST['id'];
            $this->_model->title = $_POST['title'];
            $this->_model->info = $_POST['info'];
            $this->_model->addVoteChild()?Tool::alertLocation(null,'?action=show'):Tool::alertBack('新增失败');
        }


    }

    private function update()
    {
    }


    private function del()
    {
        if($this->_model->id = $_GET['id']){
            $this->_model->delVote();
        }
        Tool::alertLocation(null,PREV_URL);
    }
}



