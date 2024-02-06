// withHooks
import { memo } from 'react';
import { useEffect, useState } from 'react';

import React from 'react';
import { Image, Pressable, Text, TouchableOpacity, View } from 'react-native';
import { FlatList, ScrollView } from 'react-native-gesture-handler';
import useSafeState from 'esoftplay/state';
import moment from 'esoftplay/moment';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';


export interface TeacherHomeArgs {

}
export interface TeacherHomeProps {

}


function m(props: TeacherHomeProps): any {


  //mengambil data dari userClass
  const data = UserClass.state().get()
  const [isLoading, setIsLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | undefined>();
  const [time, setTime] = useSafeState(moment().format('HH:mm'));
  const [ApiResponse, setResApi] = useSafeState<any>();
  const [ApiResponse2, setResApi2] = useSafeState<any>();

  const allTabs = ['Today Schadule', 'Tomorrow Schadule'];
  const [selectTab, setSelectTab] = React.useState(allTabs[0])

  let apikey: string = String(data.apikey) ?? ''

  useEffect(() => {
    const url: string = "http://api.school.lc/teacher_schedule"
    console.log('apikey', apikey)
    
    new LibCurl('teacher_schedule', get,
      (result, msg) => {
        console.log('Jadwal Result:', result);
        console.log("msg", msg)
        setResApi(result)

      },
      (err) => {
        console.log("error", err)
      }, 1)

      let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
      console.log("TommorowDate", TommorowDate)
      let CurrentDate = moment().format('YYYY-MM-DD');
      console.log("CurrentDate", CurrentDate)
      
      // get schadule tomorrow from api
      let url1: string = 'http://api.school.lc/teacher_schedule?date=' + TommorowDate
      new LibCurl('teacher_schedule?date=' + TommorowDate, get, (result, msg) => {
        console.log('Jadwal Result besok:', result);
        console.log("msg", msg)
        setResApi2(result)
      }, (err) => {
        console.log("error", err)
      }, 1)
  }, [])



  const testcallApi = (Api: any) => {
    console.log('time', moment().format('HH:mm'))
    console.log("testcallApi")

    console.log("length data schedule", Api.schedule.length)

    console.log("Api", Api.schedule[0].course_name, 'Api command : Api.schedule[0].course_name')
    console.log('\n masuk ke object class')
    console.log("Api", Api.schedule[0].class.id, 'Api command : Api.schedule[0].class.id')
    console.log("Api", Api.schedule[0].class.class_name, 'Api command : Api.schedule[0].class.class_name')
    console.log('------------------')
    console.log("Api", Api.schedule[0].clock_start, 'Api command : Api.schedule[0].clock_start')
    console.log("Api", Api.schedule[0].clock_end, 'Api command : Api.schedule[0].clock_end')
    console.log("Api", Api.schedule[0].student_number, 'Api command : Api.schedule[0].student_number')
    console.log("Api", Api.schedule[0].student_attend, 'Api command : Api.schedule[0].student_attend')
    console.log('------------------')


  }




  const isBetweentime = (clock_start: string, clock_end: string) => {
    const currentTime = moment().format('HH:mm');
    console.log("currentTime", currentTime)
    return currentTime >= clock_start && currentTime < clock_end;
  };

  const Tab = () => {
    let TommorowDate = moment().add(1, "days").format('YYYY-MM-DD');
    console.log("TommorowDate", TommorowDate)
    let CurrentDate = moment().format('YYYY-MM-DD');
    console.log("CurrentDate", CurrentDate)
    if (selectTab === allTabs[0]) {
      return (

        <FlatList data={ApiResponse?.schedule ?? []}
          style={{ height: 'auto', }}
          showsVerticalScrollIndicator={false}
          keyExtractor={(item, index) => index.toString()}
          renderItem={
            ({ item }) => {
              console.log("item", item)
              //<Text>{item['subject_id']['class_id'].major}</Text>
              return (
                <Pressable onPress={() => LibNavigation.navigate('teacher/attandence', { data: item.schedule_id, idclass:item.class.id,courseId:item.course.id})} style={{ backgroundColor: isBetweentime(item.clock_start, item.clock_end) ? "#ff7b00" : "gray", borderRadius: 10, marginTop: 10, flexDirection: 'row', }}>

                  <View style={{ backgroundColor: 'white', padding: 10, marginLeft: 30, width: '80%', opacity: 0.7 }}>

                    <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.class.name ?? "kelas"} {item?.schedule_id??'0'}</Text>
                      <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: "gray", justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.student_number + "/" + item.student_attend ?? "jumlah siswa"}</Text>
                      </View>
                    </View>

                    <View style={{ height: 30, }} />
                    <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_start ?? ""}</Text>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_end ?? ""}</Text>
                    </View>
                  </View>

                  <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf: 'center', marginLeft: 10 }} />

                </Pressable>
              )
            }
          } />
      )
    } else {
     


      return (
        <View>
          {/* <Text>Tanggal Hari ini {CurrentDate}</Text>
          <Text>Cek Tanggal Besok {TommorowDate}</Text> */}

          <FlatList data={ApiResponse2?.schedule ?? []}
            style={{ height: 'auto', }}
            showsVerticalScrollIndicator={false}
            keyExtractor={(item, index) => index.toString()}
            renderItem={
              ({ item }) => {
                console.log("item", item)
                //<Text>{item['subject_id']['class_id'].major}</Text>
                return (
                  <Pressable onPress={() => console.log("test")} style={{ backgroundColor:  "gray", borderRadius: 10, marginTop: 10, flexDirection: 'row', }}>

                    <View style={{ backgroundColor: 'white', padding: 10, marginLeft: 30, width: '80%', opacity: 0.7 }}>

                      <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.class.class_name ?? "kelas"}</Text>
                        <View style={{ height: 30, width: 'auto', borderRadius: 8, backgroundColor: "gray", justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10 }}>

                          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item.student_number + "/" + item.student_attend ?? "jumlah siswa"}</Text>
                        </View>
                      </View>

                      <View style={{ height: 30, }} />
                      <View style={{ flexDirection: 'row', justifyContent: 'space-between' }}>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_start ?? ""}</Text>
                        <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{item.clock_end ?? ""}</Text>
                      </View>
                    </View>

                    <LibIcon.AntDesign name="right" size={25} color="white" style={{ alignSelf: 'center', marginLeft: 10 }} />

                  </Pressable>
                )
              }
            } />
        </View>
      )
    }
  }

  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10 }}>

      <ScrollView showsVerticalScrollIndicator={false}>
        <Pressable onPress={() => testcallApi(ApiResponse)} style={{ width: 80, height: 40, backgroundColor: '#fd8801', borderRadius: 10, justifyContent: 'center', alignContent: 'center', alignSelf: 'flex-end', marginTop: 30 }}>
          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>testapi</Text>
        </Pressable>
        {/* welcome card */}
        <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', marginTop: 10 }}>
        <LibPicture
          source={esp.assets('anies.png')}
          style={{ width: 100, height: 100, borderRadius: 40, marginRight: 20 }} 
        />
          
          <View style={{ alignSelf: 'center' }}>
            <Text style={{ fontSize: 20, fontWeight: 'normal', color: 'gray' }}>Selamat datang,{time ?? 'shh'}</Text>

            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black' }}>{data.name ?? 'shh'}|{apikey}</Text>
          </View>
        </View>
        {/* schadule Tab */}

        <View style={{ flexDirection: 'row', backgroundColor: '#ffffff', alignItems: 'center', marginTop: 25, justifyContent: 'space-between' }}>
          <TouchableOpacity style={{ alignSelf: 'center', }} onPress={() => setSelectTab(allTabs[0])} key={0}>
            {/* nanti curl ke Today Schadule*/}
            <Text style={{ fontSize: 18, fontWeight: 'bold', color: 'black', textAlign: 'center' }}>Jadwal hari {ApiResponse?.day ?? 'hari'} </Text>
          </TouchableOpacity>
          <TouchableOpacity style={{ alignSelf: 'center', }} onPress={() => setSelectTab(allTabs[1])} key={1}>
            {/* nanti curl ke Tommorow*/}
            <Text style={{ fontSize: 18, fontWeight: 'bold', color: selectTab==allTabs[1]?'green':'black', textAlign: 'center', }}>Besok</Text>
          </TouchableOpacity>
        </View>

        <Tab />
      </ScrollView>


    </View>
  )
}



export default memo(m);