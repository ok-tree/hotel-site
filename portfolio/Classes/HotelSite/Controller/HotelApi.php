<?php
namespace Classes\HotelSite\Controller;

class HotelApi
{
	private $url;
	private $queryParams;
	private $apiSetting;
	
	public function __construct(){
		$this->apiSetting();
	}
	
	public function apiSetting(){
		$this->url = 'http://api.visitkorea.or.kr/openapi/service/rest/KorService/' ; /*URL*/
		$this->queryParams = '?' . urlencode('ServiceKey') . '=ServiceKey'; /*Service Key*/
	}
	
	public function hotelSearch($geoResult, $pageNo = 1){
		$this->apiSetting();
		$ch = curl_init();
		$this->url .= urlencode('locationBasedList');
		
		$this->queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('20'); /*한 페이지 결과 수*/
		$this->queryParams .= '&' . urlencode('pageNo') . '=' . urlencode($pageNo); /*현재 페이지 번호*/
		$this->queryParams .= '&' . urlencode('MobileOS') . '=' . urlencode('ETC'); /*IOS(아이폰),AND(안드로이드),WIN(원도우폰),ETC*/
		$this->queryParams .= '&' . urlencode('MobileApp') . '=' . urlencode('AppTest'); /*서비스명=어플명*/
		$this->queryParams .= '&' . urlencode('arrange') . '=' . urlencode('S'); /*대표이미지가 반드시 있는 정렬 (O=제목순, P=조회순, Q=수정일순, R=생성일순 S=거리순)*/
		$this->queryParams .= '&' . urlencode('contentTypeId') . '=' . urlencode('32');
		$this->queryParams .= '&' . urlencode('mapY') . '=' . urlencode($geoResult->location->lat);
		$this->queryParams .= '&' . urlencode('mapX') . '=' . urlencode($geoResult->location->lng);
		$this->queryParams .= '&' . urlencode('radius') . '=' . urlencode($this->getRadius($geoResult));

		curl_setopt($ch, CURLOPT_URL, $this->url . $this->queryParams);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = simplexml_load_string($response);
		//var_dump($response);
		return $response;
	}
	
	public function hotelInfo($contentsId){
		$this->apiSetting();
		$ch = curl_init();
		$this->url .= urlencode('detailCommon');
		
		$this->queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('30'); /*한 페이지 결과 수*/
		$this->queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*현재 페이지 번호*/
		$this->queryParams .= '&' . urlencode('MobileOS') . '=' . urlencode('ETC'); /*IOS(아이폰),AND(안드로이드),WIN(원도우폰),ETC*/
		$this->queryParams .= '&' . urlencode('MobileApp') . '=' . urlencode('AppTest'); /*서비스명=어플명*/
		$this->queryParams .= '&' . urlencode('contentId') . '=' . urlencode($contentsId); 
		
		$this->queryParams .= '&' . urlencode('defaultYN') . '=' . urlencode('Y'); 
		$this->queryParams .= '&' . urlencode('addrinfoYN') . '=' . urlencode('Y'); 
		$this->queryParams .= '&' . urlencode('mapinfoYN') . '=' . urlencode('Y'); 
		$this->queryParams .= '&' . urlencode('overviewYN') . '=' . urlencode('Y'); 

		curl_setopt($ch, CURLOPT_URL, $this->url . $this->queryParams);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = simplexml_load_string($response);
		//var_dump($response);
		return $response->body->items->item;
	}
	
	public function hotelImage($contentsId){
		$this->apiSetting();
		$ch = curl_init();
		$this->url .= urlencode('detailImage');
		
		$this->queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('30'); /*한 페이지 결과 수*/
		$this->queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*현재 페이지 번호*/
		$this->queryParams .= '&' . urlencode('MobileOS') . '=' . urlencode('ETC'); /*IOS(아이폰),AND(안드로이드),WIN(원도우폰),ETC*/
		$this->queryParams .= '&' . urlencode('MobileApp') . '=' . urlencode('AppTest'); /*서비스명=어플명*/
		$this->queryParams .= '&' . urlencode('contentId') . '=' . urlencode($contentsId); 
		$this->queryParams .= '&' . urlencode('imageYN') . '=' . urlencode('Y'); 
		

		curl_setopt($ch, CURLOPT_URL, $this->url . $this->queryParams);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = simplexml_load_string($response);
		//var_dump($response);
		return $response->body->items;
	}
	
	public function hotelList(){
		$this->apiSetting();
		$ch = curl_init();
		$this->url .= urlencode('searchStay');
		
		$this->queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('20'); /*한 페이지 결과 수*/
		$this->queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*현재 페이지 번호*/
		$this->queryParams .= '&' . urlencode('MobileOS') . '=' . urlencode('ETC'); /*IOS(아이폰),AND(안드로이드),WIN(원도우폰),ETC*/
		$this->queryParams .= '&' . urlencode('MobileApp') . '=' . urlencode('AppTest'); /*서비스명=어플명*/
		$this->queryParams .= '&' . urlencode('arrange') . '=' . urlencode('P'); /*대표이미지가 반드시 있는 정렬 (O=제목순, P=조회순, Q=수정일순, R=생성일순)*/

		curl_setopt($ch, CURLOPT_URL, $this->url . $this->queryParams);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		$response = curl_exec($ch);
		curl_close($ch);
		
		$response = simplexml_load_string($response);
		//var_dump($response->body->items->item);
		return $response->body->items->item;
	}
	
	public function getGeoInfo($address){
    $this->url = 'https://maps.googleapis.com/maps/api/geocode/xml?';
		
		$this->queryParams =  urlencode('key') . '=' . urlencode('ServiceKey'); 
		$this->queryParams .= '&' . urlencode('address') . '=' . urlencode($address);
		$this->queryParams .= '&' . urlencode('sensor') . '=' . urlencode('false');
		
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->url . $this->queryParams);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    if ($response === FALSE) {
        error_log('Curl failed');
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
		$response = simplexml_load_string($response);
    return $response;
	}
	
	public function getRadius($geoResult, $unit="k"){
		$latSW = (float)$geoResult->viewport->southwest->lat;
		$lngSW = (float)$geoResult->viewport->southwest->lng;
		$latNE = (float)$geoResult->viewport->northeast->lat;
		$lngNE = (float)$geoResult->viewport->northeast->lng;
			
		$theta = $lngSW - $lngNE;
		$dist = sin($this->deg2rad($latSW)) * sin($this->deg2rad($latNE)) + cos($this->deg2rad($latSW)) * cos($this->deg2rad($latNE)) * cos($this->deg2rad($theta));
		
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtolower($unit);
		if ($unit == "k") {
			return (int)(($miles * 1.609344)/2)*800;
		} else {
			return $miles;
		}
	}
	public function deg2rad($deg){
		$radians = 0.0;
		$radians = $deg * M_PI/180.0;
		return($radians);
	}
}