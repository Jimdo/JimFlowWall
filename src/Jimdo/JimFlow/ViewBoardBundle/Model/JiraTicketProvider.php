<?php

namespace Jimdo\JimFlow\ViewBoardBundle\Model;

use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketProviderInterface;
use \Jimdo\JimFlow\ViewBoardBundle\Model\TicketFactory;

class JiraTicketProvider implements TicketProviderInterface {

    const CODE_STARTS_WITH = 'J';
    private $ticketFactory;
    private $jira_protocol;
    private $jira_url;
    private $jira_user;
    private $jira_password;

    public function __construct(TicketFactory $ticketFactory, $jira_protocol, $jira_url, $jira_user, $jira_password)
    {
        $this->ticketFactory = $ticketFactory;
        $this->jira_protocol = $jira_protocol;
        $this->jira_url = $jira_url;
        $this->jira_user = $jira_user;
        $this->jira_password = $jira_password;

    }

    public function getTicketByCode($code)
    {
        $id = intval(str_replace(self::CODE_STARTS_WITH, '', $code));

        $requestUrl = sprintf ('%s://%s:%s@%s/rest/api/2/issue/%s', $this->jira_protocol, $this->jira_user, $this->jira_password, $this->jira_url, $id);
        
        $issueResponse = file_get_contents($requestUrl);
        
        $issue = json_decode($issueResponse);
        
        $title = $issue->fields->summary;
        $type =  $issue->fields->issuetype->name;
        $key = $issue->key;
        $url = sprintf ('%s://%s/browse/%s', $this->jira_protocol, $this->jira_url, $key);
        
        $ticket = $this->ticketFactory->build();

        $ticket->setTitle($title);
        $ticket->setId($id);
        $ticket->setType($type);
        $ticket->setUrl($url);

        return $ticket;
    }
    
    public function setTicketStatusByCodeAndStatus($code, $status, $newBoardColumn)
    {
        $id = intval(str_replace(self::CODE_STARTS_WITH, '', $code));
        
        $commentText = sprintf('Movement of the Kanban Card on the physical board has been detected. New Column: %s', $newBoardColumn);        
        
        $content = sprintf('{"transition": {"id": %s}, "update": {"comment": [{"add": {"body": "%s"}}]}}', $status, $commentText);
                
        $url = sprintf('%s://%s/rest/api/2/issue/%s/transitions', $this->jira_protocol, $this->jira_url, $id);
        
        $request = new Request('POST', '/', $url);
        
        $userPassword = sprintf('%s:%s', $this->jira_user, $this->jira_password);
        
        $request->addHeader('Authorization: Basic '.base64_encode($userPassword));
        $request->addHeader('Content-Type:application/json');
        $request->setContent($content);

        $response = new Response();

        $client = new FileGetContents();
        $client->send($request, $response);
    }
}