// withHooks

import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useState } from 'react';
import { FlatList, Platform, Pressable, ScrollView, Text, View } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';


export interface TeacherMyClassArgs {

}
export interface TeacherMyClassProps {

}
export default function m(props: TeacherMyClassProps): any {
  const idclass: string = LibNavigation.getArgsAll(props).clasid;

  function shadowS(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
    }
    return { elevation: value };
  }
  const allTabs = ['Jadwal Kelas', 'Daftar Siswa'];
  const [selectTab, setSelectTab] = React.useState(allTabs[0])
  const [resApi2, setResApi2] = useState<any>([])
  const [resApi, setResApi] = useState<any>([])

  const daysOfWeek = ['1', '2', '3', '4', '5', '6', '7'];
  const getDayOfWeek = () => {
    const today = new Date();
    const dayOfWeek = today.getDay() - 1 // Mendapatkan nilai antara 0 (Minggu) hingga 6 (Sabtu)

    return dayOfWeek;
  };
  const [day, setday] = useSafeState(daysOfWeek[getDayOfWeek()])

  useEffect(() => {

    const url = "http://api.test.school.esoftplay.com/teacher_schedule_class"
    // console.log('url :', url)
    new LibCurl('teacher_schedule_class', get, (result, msg) => {
      // console.log('url :', url)
      // console.log('Jadwal Result:', result);
      setResApi(result)
    }, (err) => {
      // console.log("error", err)
    }, 1)
    new LibCurl('homeroom_student?class_id=' + idclass, get, (result, msg) => {
      // console.log('Jadwal Result besok:', result);
      // console.log("msg", msg)
      setResApi2(result)
    }, (err) => {
      // console.log("error", err)
    }, 1)

  }, [])

  const schaduleData = () => {
    new LibCurl('teacher_schedule_class', get, (result, msg) => {
      // console.log('Jadwal Result:', result);
      setResApi(result)
    }, (err) => {
      // console.log("error", err)
    }, 1)
  }

  const Tabs = () => {
    if (selectTab == 'Jadwal Kelas') {

      const getDay = (date: string) => {
        switch (date) {
          case "0":
            return "Minggu"
          case "1":
            return "Senin"
          case "2":
            return "Selasa"
          case "3":
            return "Rabu"
          case "4":
            return "Kamis"
          case "5":
            return "Jumat"
          case "6":
            return "Sabtu"
          default:
            return "Minggu"
        }
      }
      const allDays = [, 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu',];
      const [selectedDay, setSelectedDay] = useState(allDays[1]);
      const scheduleData = resApi;

      const renderScheduleItem = ({ item }: { item: any }) => (
        <View style={{ marginBottom: 20, width: '100%', padding: 5 }}>
          {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>{item.day}</Text> */}
          <FlatList
            data={item.schedule}
            keyExtractor={(scheduleItem: any) => scheduleItem.schedule_id}
            renderItem={({ item: schedule }: { item: any }) => (
              <View key={schedule.schedule_id} style={{ flexDirection: 'row', backgroundColor: '#e7e7e7', borderRadius: 10, padding: 15, marginBottom: 10 }}>
                {/* You can customize this part according to your schedule data */}
                <View style={{ marginRight: 10, width: 50, height: 50, borderRadius: 25, backgroundColor: 'lightgray' }} />
                <View style={{ marginBottom: 10 }}>
                  <Text style={{ fontSize: 16, color: '#555' }}>{schedule.course_name}</Text>
                  <Text style={{ fontSize: 16, color: '#555' }}>{schedule.clock_start} - {schedule.clock_end}</Text>
                  <Text style={{ fontSize: 16, color: '#555' }}>{schedule.class.class_name}</Text>
                </View>
              </View>
            )}
          />
        </View>
      );
      return (
        <View style={{ flex: 1, backgroundColor: 'white' }}>
          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allDays.map(day => (
                <TouchableOpacity
                  key={day}
                  onPress={() => setSelectedDay(day)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedDay === day ? '#4B7AD6' : 'lightgray',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedDay === day ? 'white' : 'black' }}>{day}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>
          {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>{selectedDay}</Text> */}
          <FlatList
            data={resApi.filter((item: { day: string; }) => item.day === selectedDay)}
            scrollEnabled={true}
            keyExtractor={(item, index) => index.toString()}
            contentContainerStyle={{ width: '100%' }}
            renderItem={renderScheduleItem}
          />
        </View>
      );
    } else {

      const allStudents = [
        {
          "image": "",
          "name": "intan",
          "number": "1",
          "student_id": 1
        },
        {
          "image": "",
          "name": "dina",
          "number": "2",
          "student_id": 2
        },
        {
          "image": "",
          "name": "surya",
          "number": "3",
          "student_id": 3
        },
        {
          "image": "",
          "name": "sutejo",
          "number": "4",
          "student_id": 4
        },
        {
          "image": "",
          "name": "tarjo",
          "number": "5",
          "student_id": 5
        },
        {
          "image": "",
          "name": "agus",
          "number": "6",
          "student_id": 6
        }
      ];

      return (
        <View style={{ flex: 1, }}>
          <FlatList
            // jangan lupa di ganti allStudents jadi resApi2.student_list
            data={resApi2.student_list}
            keyExtractor={(item, index) => index.toString()}
            contentContainerStyle={{ marginTop: 10 }}
            renderItem={({ item }) => (

              <View style={{ marginBottom: 5, width: '100%', padding: 5 }}>
                <Pressable onPress={() => LibNavigation.navigate('teacher/detailstudent',
                  {
                    data: item,
                    class_id: idclass,
                    student_id: item.student_id,
                    parent: item.parent,
                    className: resApi2.class_name,
                    studentName: item.name

                  })} >

                  <View style={{ flexDirection: 'row', backgroundColor: '#e7e7e7', borderRadius: 10, padding: 15 }}>
                    <View style={{ marginRight: 10, width: 50, height: 50, borderRadius: 25, backgroundColor: 'lightgray' }} />
                    <View style={{ marginBottom: 10, }}>
                      <Text style={{ fontSize: 16, color: '#555' }}>{item.name}</Text>
                      <Text style={{ fontSize: 16, color: '#555' }}>{item.number}</Text>
                      {/* <Text style={{ fontSize: 16, color: '#555' }}>{item.parent.dada}</Text> */}
                    </View>
                  </View>
                </Pressable>
              </View>
            )}
          />
        </View>
      )
    }
  }
  return (
    <View style={{ padding: 20, flex: 1, ...shadowS(6) }}>

      <ScrollView showsVerticalScrollIndicator={false} >

        <View style={{ marginBottom: 30 }}>
          <View style={{ justifyContent: 'flex-start', alignItems: 'center', flexDirection: 'row', }}>
            <Pressable onPress={() => { LibNavigation.back() }} style={{ height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center', }}>
              <LibIcon.EntypoIcons name='chevron-left' size={35} color='gray' />
            </Pressable>
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>Kelas Ku</Text>
          </View>


          <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', justifyContent: 'space-between', marginTop: 50 }}>
            <Text style={{ fontSize: 30, fontWeight: 'bold', color: 'black' }}>{resApi2?.class_name ?? 'class_name'}</Text>
            <Pressable onPress={() => schaduleData()} style={{ alignSelf: 'center', borderRadius: 10, backgroundColor: '#dfdfdf', opacity: 0.8, padding: 5 }}>
              <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#ff0000' }}>SoeHarto</Text>
            </Pressable>
          </View>


        </View>
        <View style={{ flexDirection: 'row', margin: 20, justifyContent: 'center' }}>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[0])} key={0}
            style={{
              paddingVertical: 15, paddingHorizontal: 5, backgroundColor: selectTab === allTabs[0] ? '#136B93' : '#FFFFFF',
              justifyContent: 'center', alignItems: 'center', marginLeft: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomLeftRadius: 10, borderTopLeftRadius: 10,

            }}>
            <Text style={{ color: selectTab === allTabs[0] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[0]}</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={() => setSelectTab(allTabs[1])} key={1}
            style={{
              paddingVertical: 15, paddingHorizontal: 32, backgroundColor: selectTab === allTabs[1] ? '#136B93' : '#FFFFFF',
              justifyContent: 'center', alignItems: 'center', marginRight: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomRightRadius: 10, borderTopRightRadius: 10,
            }}>
            <Text style={{ color: selectTab === allTabs[1] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{selectTab}</Text>
          </TouchableOpacity>
        </View>

        <Tabs />
      </ScrollView>


    </View>
  )
}


