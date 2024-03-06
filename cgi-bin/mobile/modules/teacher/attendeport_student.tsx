// withHooks
import { memo } from 'react';

import { MaterialIconsTypes } from '@expo/vector-icons/build/esoftplay_icons';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibInput_rectangle2 } from 'esoftplay/cache/lib/input_rectangle2/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import esp from 'esoftplay/esp';
import moment from 'esoftplay/moment';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useRef, useState } from 'react';
import { FlatList, Modal, Pressable, Text, TouchableOpacity, View } from 'react-native';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';


export interface AttendReportStudentArgs {
    
}
export interface AttendReportStudentProps {
    
}
function m(props: AttendReportStudentProps): any {
   
    const [ApiResponse, setResApi] = useSafeState<any>();
    //<Pressable onPress={() => LibNavigation.navigate('teacher/attendeport_student', { idclas: item?.class?.id, date: dates ,schedule_id:item.schedule_id})}> 
    const schadule_id: string = LibNavigation.getArgsAll(props).schedule_id;
    const dates:string = LibNavigation.getArgsAll(props).date;
    const idclass: string = LibNavigation.getArgsAll(props).idclas;
  
   
    useEffect(() => {
  
      // console.log(moment().format('YYYY-MM-DD'))
      // jangan lupa ganti class_id dan schadule_id dan date di url 
      //   http://api.test.school.esoftplay.com/student_class?class_id=1
      const url: string = "http://api.test.school.esoftplay.com/student_class?class_id=1&schedule_id=1&date=" + dates
  
    console.log("idclass", idclass)
  
      new LibCurl("student_class?class_id=" + idclass + "&schedule_id=" + schadule_id + "&date=" + dates, get,
        (result, msg) => {
           console.log('Jadwal Result:', result);
          // console.log("msg", msg)
          setResApi(result)
        
        
          // console.log("link", url)
          // console.log("data", data)
        },
        (err) => {
          console.log("error", err)
        }, 1)
  
  
    }, [])
  
  
    let timeStart = ApiResponse?.clock_start ?? ''
    let timeEnd = ApiResponse?.clock_end ?? ''
    let time: string = timeStart + " - " + timeEnd
  
   
  
    return (
      <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center', padding: 10 }}>
        {/* daftar siswa */}
        <FlatList data={ApiResponse?.student_list ?? []}
          showsVerticalScrollIndicator={false}
          contentContainerStyle={{ marginTop: LibStyle.STATUSBAR_HEIGHT, backgroundColor: 'white', paddingBottom: 75 }}
          ListHeaderComponent={
            <View >
              <View style={{ flexDirection: 'row', alignItems: 'center', height: 30, justifyContent: 'space-between' }}>
                <Pressable onPress={() => LibNavigation.back()} style={{ alignItems: 'center', }}>
                  <View style={{ flexDirection: 'row', alignItems: 'center', marginRight: 20 }}>
                    <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
                    <Text style={{ fontSize: 20 }}>{ApiResponse?.class_name ?? ''}| {ApiResponse?.schedule_id}</Text>
                  </View>
                </Pressable>
                <Text style={{ fontSize: 20 }}>{time}</Text>
              </View>
              {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 10 }}>student_class?class_id={idclass}&schedule_id={schadule_id}&date={dates}</Text>  */}
  
              <View style={{ flexDirection: 'row', justifyContent: 'space-evenly', marginTop: 10 }}>
                {/* Berangkat */}
                <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'green', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_present ?? '0'}</Text>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_present ?? '0'}</Text> */}
                  <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Berangkat</Text>
                </View>
                {/* Sakit */}
                <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'orange', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_s ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_s ?? '0'}</Text>
                  <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Sakit</Text>
                </View>
                {/* Izin */}
                <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#0083FD', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_i ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_i ?? '0'}</Text>
                  <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Ijin</Text>
                </View>
                {/* Alfa */}
                <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#FF4343', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                  {/* <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_a ?? '0'}</Text> */}
                  <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{ApiResponse?.permission?.total_a ?? '0'}</Text>
                  <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Alfa</Text>
                </View>
  
              </View>
              {/* seperator */}
              <View style={{ height: 5, width: 'auto', backgroundColor: 'gray', marginTop: 10, marginHorizontal: 10, justifyContent: 'center', borderRadius: 5 }} />
            </View>
          }
          keyExtractor={(item, index) => index.toString()}
          renderItem={
            ({ item, index }) => {
  
              function getStudentStatus(statusCode: number) {
                let status = '';
  
                switch (statusCode) {
                  case 1:
                    status = 'Hadir';
                    break;
                  case 2:
                    status = 'Sakit';
                    break;
                  case 3:
                    status = 'Ijin';
                    break;
                  case 4:
                    status = 'Tidak Hadir';
                    break;
                  default:
                    status = 'Unknown';
                }
  
                return status;
              }
              function getStudentColor(statusCode: number) {
                let color = '';
  
                switch (statusCode) {
                  case 1:
                    color = '#0DBD5E';
                    break;
                  case 2:
                    color = 'orange';
                    break;
                  case 3:
                    color = '#0083fd';
                    break;
                  case 4:
                    color = '#FF4343';
                    break;
  
                  default:
                    color = 'Unknown';
                }
  
                return color;
              }
              return (
                <View style={{ flexDirection: 'row', justifyContent: 'flex-start', marginTop: 10, alignItems: 'center', padding: 10, }}>
                
                    <View style={{ flexDirection: 'row', justifyContent: 'flex-start', padding: 10, backgroundColor: getStudentColor(item.status), borderRadius: 10, height: 90, width: LibStyle.width - 40 }}>
                      <View style={{ marginLeft: 5, alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', width: 40 }}>
                        <Text style={{ fontSize: 20, fontWeight: 'bold' }}>{item.number ?? 0}</Text>
                      </View>
                      {/* nama siswa  && keterangan*/}
                      <View style={{ marginLeft: 10, alignItems: 'flex-start', justifyContent: 'center' }}>
                        <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{String(item.name) ?? "tejo"} </Text>
  
                        <View style={{ alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 5, justifyContent: 'center', marginTop: 10 }}>
                          <Text style={{ fontSize: 14, fontWeight: 'bold' }}>{getStudentStatus(item.status)} {item?.notes ?? ''} </Text>
                        </View>
  
                      </View>
  
  
                    </View>
                    {/* make a circle */}
                    {/*  style={{ backgroundColor: getStudentColor(item.status), borderRadius: 50, marginLeft: 20, padding: 20, height: 60, width: 60, alignItems: 'center', justifyContent: 'center' }} */}
                    {/* <LibIcon name={icon} size={34} color="#ffffff" /> */}
                
                </View>
              )
            }} />
       
   
      
  
      </View>
    )
}
export default memo(m);